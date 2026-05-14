<?php

namespace App\Http\Controllers;

use App\Models\Cite;
use App\Models\Diagnostic;
use App\Models\Medic;
use App\Models\Pacient;
use App\Models\Treatment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index(Request $request): Renderable
    {
        $user = $request->user()->load('pacient');
        $medics = Medic::orderBy('apellido')->orderBy('nombre')->get();

        if ($user->isAdmin()) {
            $stats = [
                'pacients' => Pacient::count(),
                'cites' => Cite::count(),
                'pending_cites' => Cite::where('estado', 'Pendiente')->count(),
                'active_treatments' => Treatment::where('estado', 'Activo')->count(),
            ];

            $recentPacients = Pacient::with('user')->latest()->take(6)->get();
            $recentCites = Cite::with(['pacients', 'medics'])->orderByDesc('fecha')->take(6)->get();
            $recentTreatments = Treatment::with(['diagnostics.pacients', 'medics'])
                ->orderByDesc('created_at')
                ->take(6)
                ->get();
            $diagnostics = Diagnostic::with(['pacients', 'medics'])->orderByDesc('fecha')->get();
            $managedCites = Cite::with(['pacients', 'medics'])->orderByDesc('fecha')->get();
            $managedTreatments = Treatment::with(['diagnostics.pacients', 'medics'])
                ->orderByDesc('created_at')
                ->get();

            return view('home', [
                'mode' => 'admin',
                'stats' => $stats,
                'recentPacients' => $recentPacients,
                'recentCites' => $recentCites,
                'recentTreatments' => $recentTreatments,
                'pacient' => null,
                'userCites' => collect(),
                'userTreatments' => collect(),
                'userDiagnostics' => collect(),
                'pacients' => Pacient::with('user')->orderBy('apellido')->orderBy('nombre')->get(),
                'medics' => $medics,
                'diagnostics' => $diagnostics,
                'managedCites' => $managedCites,
                'managedTreatments' => $managedTreatments,
                'citeStatuses' => $this->citeStatuses(),
                'treatmentStatuses' => $this->treatmentStatuses(),
            ]);
        }

        $pacient = $user->pacient;

        $userCites = collect();
        $userDiagnostics = collect();
        $userTreatments = collect();

        if ($pacient) {
            $userCites = Cite::with('medics')
                ->where('id_pacient', $pacient->id_pacient)
                ->orderBy('fecha')
                ->get();

            $userDiagnostics = Diagnostic::with('medics')
                ->where('id_pacient', $pacient->id_pacient)
                ->orderByDesc('fecha')
                ->get();

            $userTreatments = Treatment::with(['diagnostics', 'medics', 'medications'])
                ->whereHas('diagnostics', function ($query) use ($pacient) {
                    $query->where('id_pacient', $pacient->id_pacient);
                })
                ->orderByDesc('created_at')
                ->get();
        }

        return view('home', [
            'mode' => 'patient',
            'stats' => [
                'cites' => $userCites->count(),
                'pending_cites' => $userCites->where('estado', 'Pendiente')->count(),
                'active_treatments' => $userTreatments->where('estado', 'Activo')->count(),
                'diagnostics' => $userDiagnostics->count(),
            ],
            'recentPacients' => collect(),
            'recentCites' => collect(),
            'recentTreatments' => collect(),
            'pacient' => $pacient,
            'userCites' => $userCites,
            'userTreatments' => $userTreatments,
            'userDiagnostics' => $userDiagnostics,
            'pacients' => collect(),
            'medics' => $medics,
            'diagnostics' => collect(),
            'managedCites' => collect(),
            'managedTreatments' => collect(),
            'citeStatuses' => $this->citeStatuses(),
            'treatmentStatuses' => $this->treatmentStatuses(),
        ]);
    }

    private function citeStatuses(): array
    {
        return ['Pendiente', 'Confirmada', 'Completada', 'Cancelada'];
    }

    private function treatmentStatuses(): array
    {
        return ['Activo', 'Completado', 'Suspendido'];
    }
}
