<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCiteRequest;
use App\Http\Requests\StoreMedicRequest;
use App\Http\Requests\StorePacientRequest;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Models\Cite;
use App\Models\Medic;
use App\Models\Pacient;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeCite(StoreCiteRequest $request): RedirectResponse
    {
        $user = $request->user()->loadMissing('pacient');

        if (! $user->isAdmin() && ! $user->pacient) {
            return redirect()
                ->route('home')
                ->withErrors(['cites' => 'Tu cuenta todavia no esta vinculada a un paciente.'])
                ->withInput();
        }

        $data = $request->validated();

        if ($user->isAdmin()) {
            $data['estado'] = $data['estado'] ?? 'Pendiente';
        } else {
            $data['id_pacient'] = $user->pacient->id_pacient;
            $data['estado'] = 'Pendiente';
        }

        Cite::create($data);

        return redirect()
            ->route('home')
            ->with('status', $user->isAdmin() ? 'Cita creada correctamente.' : 'Tu cita fue registrada correctamente.');
    }

    public function updateCite(UpdateCiteRequest $request, Cite $cite): RedirectResponse
    {
        $cite->update($request->validated());

        return redirect()->route('home')->with('status', 'Cita actualizada correctamente.');
    }

    public function destroyCite(Request $request, Cite $cite): RedirectResponse
    {
        $this->ensureAdmin($request);

        $cite->delete();

        return redirect()->route('home')->with('status', 'Cita eliminada correctamente.');
    }

    public function storeTreatment(StoreTreatmentRequest $request): RedirectResponse
    {
        Treatment::create($request->validated());

        return redirect()->route('home')->with('status', 'Tratamiento creado correctamente.');
    }

    public function updateTreatment(UpdateTreatmentRequest $request, Treatment $treatment): RedirectResponse
    {
        $treatment->update($request->validated());

        return redirect()->route('home')->with('status', 'Tratamiento actualizado correctamente.');
    }

    public function destroyTreatment(Request $request, Treatment $treatment): RedirectResponse
    {
        $this->ensureAdmin($request);

        $treatment->delete();

        return redirect()->route('home')->with('status', 'Tratamiento eliminado correctamente.');
    }

    public function storeMedic(StoreMedicRequest $request): RedirectResponse
    {
        Medic::create($request->validated());

        return redirect()->route('home')->with('status', 'Medico creado correctamente.');
    }

    public function storePacient(StorePacientRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $username = $this->generatePatientUsername($data['nombre'], $data['apellido']);

        DB::transaction(function () use ($data, $username): void {
            $user = User::create([
                'name' => trim($data['nombre'].' '.$data['apellido']),
                'username' => $username,
                'email' => $this->buildPatientEmail($username),
                'role' => 'patient',
                'password' => $data['password'],
            ]);

            Pacient::create([
                'user_id' => $user->id,
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'genero' => $data['genero'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'tipo_sangre' => $data['tipo_sangre'],
            ]);
        });

        return redirect()
            ->route('home')
            ->with('status', "Paciente creado correctamente. Usuario generado: {$username}");
    }

    private function ensureAdmin(Request $request): void
    {
        abort_unless($request->user()?->isAdmin(), 403);
    }

    private function generatePatientUsername(string $nombre, string $apellido): string
    {
        $nameParts = $this->splitWords($nombre);
        $surnameParts = $this->splitWords($apellido);

        $firstNameInitial = Str::substr($nameParts[0] ?? 'u', 0, 1);
        $firstSurname = $surnameParts[0] ?? 'paciente';
        $secondSurnameInitial = Str::substr($surnameParts[1] ?? '', 0, 1);

        $base = Str::lower(preg_replace('/[^A-Za-z0-9]/', '', Str::ascii($firstNameInitial.$firstSurname.$secondSurnameInitial)) ?? '');
        $base = $base !== '' ? $base : 'paciente';
        $username = $base;
        $suffix = 1;

        while (User::query()->where('username', $username)->exists()) {
            $suffix++;
            $username = $base.$suffix;
        }

        return $username;
    }

    private function buildPatientEmail(string $username): string
    {
        return $username.'@paciente.local';
    }

    /**
     * @return array<int, string>
     */
    private function splitWords(string $value): array
    {
        $normalized = preg_replace('/\s+/', ' ', trim(Str::ascii($value))) ?? '';

        if ($normalized === '') {
            return [];
        }

        return array_values(array_filter(explode(' ', $normalized)));
    }
}
