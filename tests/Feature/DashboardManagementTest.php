<?php

namespace Tests\Feature;

use App\Http\Controllers\HomeController;
use App\Models\Cite;
use App\Models\Diagnostic;
use App\Models\Medic;
use App\Models\Pacient;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_create_a_cite_from_the_dashboard(): void
    {
        $user = User::create([
            'name' => 'Paciente Demo',
            'username' => 'paciente-demo',
            'email' => 'paciente@example.com',
            'role' => 'patient',
            'password' => Hash::make('password'),
        ]);

        $pacient = Pacient::create([
            'user_id' => $user->id,
            'nombre' => 'Ana',
            'apellido' => 'Lopez',
            'fecha_nacimiento' => '1995-03-01',
            'genero' => 'F',
            'telefono' => '999111222',
            'direccion' => 'Av. Lima 123',
            'tipo_sangre' => 'O+',
        ]);

        $otherPacient = Pacient::create([
            'nombre' => 'Carlos',
            'apellido' => 'Ramos',
            'fecha_nacimiento' => '1990-04-02',
            'genero' => 'M',
            'telefono' => '988777666',
            'direccion' => 'Jr. Sol 456',
            'tipo_sangre' => 'A+',
        ]);

        $medic = Medic::create([
            'nombre' => 'Mario',
            'apellido' => 'Perez',
            'especialidad' => 'Cardiologia',
            'telefono' => '900123123',
            'email' => 'mario.perez@example.com',
            'licencia' => 'LIC-001',
            'anios_experiencia' => 8,
        ]);

        $response = $this->actingAs($user)->post(route('dashboard.cites.store'), [
            'fecha' => '2026-06-15 10:30:00',
            'motivo' => 'Control general',
            'id_pacient' => $otherPacient->id_pacient,
            'id_medic' => $medic->id_medic,
            'estado' => 'Cancelada',
            'observaciones' => 'Paciente solicita revision.',
            'sala' => 'Consultorio 3',
        ]);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('cites', [
            'motivo' => 'Control general',
            'id_pacient' => $pacient->id_pacient,
            'id_medic' => $medic->id_medic,
            'estado' => 'Pendiente',
            'sala' => 'Consultorio 3',
        ]);
    }

    public function test_admin_can_manage_cites_treatments_and_medics(): void
    {
        $admin = User::create([
            'name' => 'Admin Demo',
            'username' => 'admin-demo',
            'email' => 'admin-demo@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $pacient = Pacient::create([
            'nombre' => 'Lucia',
            'apellido' => 'Torres',
            'fecha_nacimiento' => '1988-10-10',
            'genero' => 'F',
            'telefono' => '977111333',
            'direccion' => 'Av. Norte 789',
            'tipo_sangre' => 'B+',
        ]);

        $medic = Medic::create([
            'nombre' => 'Elena',
            'apellido' => 'Ruiz',
            'especialidad' => 'Dermatologia',
            'telefono' => '955444555',
            'email' => 'elena.ruiz@example.com',
            'licencia' => 'LIC-002',
            'anios_experiencia' => 12,
        ]);

        $diagnostic = Diagnostic::create([
            'descripcion' => 'Dermatitis atopica',
            'fecha' => '2026-05-12 09:00:00',
            'id_pacient' => $pacient->id_pacient,
            'id_medic' => $medic->id_medic,
            'gravedad' => 'Media',
            'recomendaciones' => 'Control y seguimiento.',
            'tipo_diagnostico' => 'Clinico',
        ]);

        $createdMedicResponse = $this->actingAs($admin)->post(route('dashboard.medics.store'), [
            'nombre' => 'Raul',
            'apellido' => 'Mendoza',
            'especialidad' => 'Pediatria',
            'telefono' => '966555444',
            'email' => 'raul.mendoza@example.com',
            'licencia' => 'LIC-003',
            'anios_experiencia' => 6,
        ]);

        $createdMedicResponse->assertRedirect(route('home'));
        $this->assertDatabaseHas('medics', [
            'email' => 'raul.mendoza@example.com',
            'especialidad' => 'Pediatria',
        ]);

        $createdCiteResponse = $this->actingAs($admin)->post(route('dashboard.cites.store'), [
            'fecha' => '2026-06-20 14:15:00',
            'motivo' => 'Revision de piel',
            'id_pacient' => $pacient->id_pacient,
            'id_medic' => $medic->id_medic,
            'estado' => 'Confirmada',
            'observaciones' => 'Revisar evolucion.',
            'sala' => 'Consultorio 5',
        ]);

        $createdCiteResponse->assertRedirect(route('home'));

        $cite = Cite::query()->where('motivo', 'Revision de piel')->firstOrFail();

        $updatedCiteResponse = $this->actingAs($admin)->put(route('dashboard.cites.update', $cite), [
            'fecha' => '2026-06-21 15:45:00',
            'motivo' => 'Revision dermatologica',
            'id_pacient' => $pacient->id_pacient,
            'id_medic' => $medic->id_medic,
            'estado' => 'Completada',
            'observaciones' => 'Paciente atendida.',
            'sala' => 'Consultorio 6',
        ]);

        $updatedCiteResponse->assertRedirect(route('home'));
        $this->assertDatabaseHas('cites', [
            'id_cita' => $cite->id_cita,
            'motivo' => 'Revision dermatologica',
            'estado' => 'Completada',
            'sala' => 'Consultorio 6',
        ]);

        $createdTreatmentResponse = $this->actingAs($admin)->post(route('dashboard.treatments.store'), [
            'nombre' => 'Tratamiento topico',
            'descripcion' => 'Aplicacion de crema durante 15 dias.',
            'duracion' => '15 dias',
            'id_diagnostic' => $diagnostic->id_diagnostic,
            'id_medic' => $medic->id_medic,
            'estado' => 'Activo',
            'frecuencia_administracion' => 'Cada 12 horas',
        ]);

        $createdTreatmentResponse->assertRedirect(route('home'));

        $treatment = Treatment::query()->where('nombre', 'Tratamiento topico')->firstOrFail();

        $updatedTreatmentResponse = $this->actingAs($admin)->put(route('dashboard.treatments.update', $treatment), [
            'nombre' => 'Tratamiento topico reforzado',
            'descripcion' => 'Aplicacion y control semanal.',
            'duracion' => '21 dias',
            'id_diagnostic' => $diagnostic->id_diagnostic,
            'id_medic' => $medic->id_medic,
            'estado' => 'Suspendido',
            'frecuencia_administracion' => 'Cada 24 horas',
        ]);

        $updatedTreatmentResponse->assertRedirect(route('home'));
        $this->assertDatabaseHas('treatments', [
            'id_treatment' => $treatment->id_treatment,
            'nombre' => 'Tratamiento topico reforzado',
            'estado' => 'Suspendido',
        ]);

        $deletedTreatmentResponse = $this->actingAs($admin)->delete(route('dashboard.treatments.destroy', $treatment));
        $deletedTreatmentResponse->assertRedirect(route('home'));
        $this->assertDatabaseMissing('treatments', [
            'id_treatment' => $treatment->id_treatment,
        ]);

        $deletedCiteResponse = $this->actingAs($admin)->delete(route('dashboard.cites.destroy', $cite));
        $deletedCiteResponse->assertRedirect(route('home'));
        $this->assertDatabaseMissing('cites', [
            'id_cita' => $cite->id_cita,
        ]);
    }

    public function test_admin_can_create_patient_with_generated_username_and_patient_can_view_admin_cite(): void
    {
        $admin = User::create([
            'name' => 'Admin Demo',
            'username' => 'admin-patient-flow',
            'email' => 'admin-patient-flow@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $medic = Medic::create([
            'nombre' => 'Sofia',
            'apellido' => 'Quispe',
            'especialidad' => 'Medicina general',
            'telefono' => '900555111',
            'email' => 'sofia.quispe@example.com',
            'licencia' => 'LIC-100',
            'anios_experiencia' => 9,
        ]);

        $createPatientResponse = $this->actingAs($admin)->post(route('dashboard.pacients.store'), [
            'nombre' => 'Andre',
            'apellido' => 'Vega Minaya',
            'fecha_nacimiento' => '2000-01-15',
            'genero' => 'M',
            'telefono' => '987654321',
            'direccion' => 'Av. Siempre Viva 123',
            'tipo_sangre' => 'O+',
            'password' => 'secreto123',
            'password_confirmation' => 'secreto123',
        ]);

        $createPatientResponse->assertRedirect(route('home'));
        $createPatientResponse->assertSessionHas('status', 'Paciente creado correctamente. Usuario generado: avegam');

        $user = User::query()->where('username', 'avegam')->firstOrFail();
        $pacient = Pacient::query()->where('user_id', $user->id)->firstOrFail();

        $this->assertSame('Andre Vega Minaya', $user->name);
        $this->assertSame('avegam@paciente.local', $user->email);
        $this->assertTrue(Hash::check('secreto123', $user->password));

        $this->actingAs($admin)->post(route('dashboard.cites.store'), [
            'fecha' => '2026-07-10 08:00:00',
            'motivo' => 'Chequeo anual',
            'id_pacient' => $pacient->id_pacient,
            'id_medic' => $medic->id_medic,
            'estado' => 'Confirmada',
            'observaciones' => 'Traer analisis previos.',
            'sala' => 'Consultorio 1',
        ])->assertRedirect(route('home'));

        $request = Request::create(route('home'), 'GET');
        $request->setUserResolver(fn () => $user);

        $view = app(HomeController::class)->index($request);
        $data = $view->getData();

        $this->assertSame('patient', $data['mode']);
        $this->assertCount(1, $data['userCites']);
        $this->assertSame('Chequeo anual', $data['userCites']->first()->motivo);
        $this->assertSame('Confirmada', $data['userCites']->first()->estado);
        $this->assertSame('Sofia', $data['userCites']->first()->medics->nombre);
        $this->assertSame('Quispe', $data['userCites']->first()->medics->apellido);
    }
}
