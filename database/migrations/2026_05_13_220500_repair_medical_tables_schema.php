<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->renamePrimaryKeyIfNeeded('pacients', 'id', 'id_pacient');
        $this->renamePrimaryKeyIfNeeded('medics', 'id', 'id_medic');
        $this->renamePrimaryKeyIfNeeded('cites', 'id', 'id_cita');
        $this->renamePrimaryKeyIfNeeded('diagnostics', 'id', 'id_diagnostic');
        $this->renamePrimaryKeyIfNeeded('treatments', 'id', 'id_treatment');
        $this->renamePrimaryKeyIfNeeded('medications', 'id', 'id_medication');

        Schema::table('pacients', function (Blueprint $table) {
            if (! Schema::hasColumn('pacients', 'nombre')) {
                $table->string('nombre')->after('id_pacient');
            }
            if (! Schema::hasColumn('pacients', 'apellido')) {
                $table->string('apellido')->after('nombre');
            }
            if (! Schema::hasColumn('pacients', 'fecha_nacimiento')) {
                $table->date('fecha_nacimiento')->after('apellido');
            }
            if (! Schema::hasColumn('pacients', 'genero')) {
                $table->string('genero')->after('fecha_nacimiento');
            }
            if (! Schema::hasColumn('pacients', 'telefono')) {
                $table->string('telefono')->after('genero');
            }
            if (! Schema::hasColumn('pacients', 'direccion')) {
                $table->string('direccion')->after('telefono');
            }
            if (! Schema::hasColumn('pacients', 'tipo_sangre')) {
                $table->string('tipo_sangre')->after('direccion');
            }
        });

        Schema::table('medics', function (Blueprint $table) {
            if (! Schema::hasColumn('medics', 'nombre')) {
                $table->string('nombre')->after('id_medic');
            }
            if (! Schema::hasColumn('medics', 'apellido')) {
                $table->string('apellido')->after('nombre');
            }
            if (! Schema::hasColumn('medics', 'especialidad')) {
                $table->string('especialidad')->after('apellido');
            }
            if (! Schema::hasColumn('medics', 'telefono')) {
                $table->string('telefono')->after('especialidad');
            }
            if (! Schema::hasColumn('medics', 'email')) {
                $table->string('email')->after('telefono');
            }
            if (! Schema::hasColumn('medics', 'licencia')) {
                $table->string('licencia')->after('email');
            }
            if (! Schema::hasColumn('medics', 'anios_experiencia')) {
                $table->integer('anios_experiencia')->after('licencia');
            }
        });

        Schema::table('diagnostics', function (Blueprint $table) {
            if (! Schema::hasColumn('diagnostics', 'descripcion')) {
                $table->text('descripcion')->after('id_diagnostic');
            }
            if (! Schema::hasColumn('diagnostics', 'fecha')) {
                $table->dateTime('fecha')->after('descripcion');
            }
            if (! Schema::hasColumn('diagnostics', 'id_pacient')) {
                $table->unsignedBigInteger('id_pacient')->after('fecha');
            }
            if (! Schema::hasColumn('diagnostics', 'id_medic')) {
                $table->unsignedBigInteger('id_medic')->after('id_pacient');
            }
            if (! Schema::hasColumn('diagnostics', 'gravedad')) {
                $table->string('gravedad')->after('id_medic');
            }
            if (! Schema::hasColumn('diagnostics', 'recomendaciones')) {
                $table->text('recomendaciones')->after('gravedad');
            }
            if (! Schema::hasColumn('diagnostics', 'tipo_diagnostico')) {
                $table->string('tipo_diagnostico')->after('recomendaciones');
            }
        });

        Schema::table('treatments', function (Blueprint $table) {
            if (! Schema::hasColumn('treatments', 'nombre')) {
                $table->string('nombre')->after('id_treatment');
            }
            if (! Schema::hasColumn('treatments', 'descripcion')) {
                $table->text('descripcion')->after('nombre');
            }
            if (! Schema::hasColumn('treatments', 'duracion')) {
                $table->string('duracion')->after('descripcion');
            }
            if (! Schema::hasColumn('treatments', 'id_diagnostic')) {
                $table->unsignedBigInteger('id_diagnostic')->after('duracion');
            }
            if (! Schema::hasColumn('treatments', 'id_medic')) {
                $table->unsignedBigInteger('id_medic')->after('id_diagnostic');
            }
            if (! Schema::hasColumn('treatments', 'estado')) {
                $table->string('estado')->after('id_medic');
            }
            if (! Schema::hasColumn('treatments', 'frecuencia_administracion')) {
                $table->string('frecuencia_administracion')->after('estado');
            }
        });

        Schema::table('medications', function (Blueprint $table) {
            if (! Schema::hasColumn('medications', 'nombre')) {
                $table->string('nombre')->after('id_medication');
            }
            if (! Schema::hasColumn('medications', 'dosis')) {
                $table->string('dosis')->after('nombre');
            }
            if (! Schema::hasColumn('medications', 'frecuencia')) {
                $table->string('frecuencia')->after('dosis');
            }
            if (! Schema::hasColumn('medications', 'duracion')) {
                $table->string('duracion')->after('frecuencia');
            }
            if (! Schema::hasColumn('medications', 'id_treatment')) {
                $table->unsignedBigInteger('id_treatment')->after('duracion');
            }
            if (! Schema::hasColumn('medications', 'proveedor')) {
                $table->string('proveedor')->after('id_treatment');
            }
            if (! Schema::hasColumn('medications', 'efectos_secundarios')) {
                $table->text('efectos_secundarios')->after('proveedor');
            }
        });

        Schema::table('cites', function (Blueprint $table) {
            if (! Schema::hasColumn('cites', 'fecha')) {
                $table->dateTime('fecha')->after('id_cita');
            }
            if (! Schema::hasColumn('cites', 'motivo')) {
                $table->string('motivo')->after('fecha');
            }
            if (! Schema::hasColumn('cites', 'id_pacient')) {
                $table->unsignedBigInteger('id_pacient')->after('motivo');
            }
            if (! Schema::hasColumn('cites', 'id_medic')) {
                $table->unsignedBigInteger('id_medic')->after('id_pacient');
            }
            if (! Schema::hasColumn('cites', 'estado')) {
                $table->string('estado')->after('id_medic');
            }
            if (! Schema::hasColumn('cites', 'observaciones')) {
                $table->text('observaciones')->nullable()->after('estado');
            }
            if (! Schema::hasColumn('cites', 'sala')) {
                $table->string('sala')->after('observaciones');
            }
        });

        Schema::table('diagnostics', function (Blueprint $table) {
            if (! $this->hasForeignKey('diagnostics', 'diagnostics_id_pacient_foreign')) {
                $table->foreign('id_pacient')->references('id_pacient')->on('pacients')->cascadeOnDelete();
            }
            if (! $this->hasForeignKey('diagnostics', 'diagnostics_id_medic_foreign')) {
                $table->foreign('id_medic')->references('id_medic')->on('medics')->cascadeOnDelete();
            }
        });

        Schema::table('cites', function (Blueprint $table) {
            if (! $this->hasForeignKey('cites', 'cites_id_pacient_foreign')) {
                $table->foreign('id_pacient')->references('id_pacient')->on('pacients')->cascadeOnDelete();
            }
            if (! $this->hasForeignKey('cites', 'cites_id_medic_foreign')) {
                $table->foreign('id_medic')->references('id_medic')->on('medics')->cascadeOnDelete();
            }
        });

        Schema::table('treatments', function (Blueprint $table) {
            if (! $this->hasForeignKey('treatments', 'treatments_id_diagnostic_foreign')) {
                $table->foreign('id_diagnostic')->references('id_diagnostic')->on('diagnostics')->cascadeOnDelete();
            }
            if (! $this->hasForeignKey('treatments', 'treatments_id_medic_foreign')) {
                $table->foreign('id_medic')->references('id_medic')->on('medics')->cascadeOnDelete();
            }
        });

        Schema::table('medications', function (Blueprint $table) {
            if (! $this->hasForeignKey('medications', 'medications_id_treatment_foreign')) {
                $table->foreign('id_treatment')->references('id_treatment')->on('treatments')->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    protected function renamePrimaryKeyIfNeeded(string $table, string $from, string $to): void
    {
        if (Schema::hasColumn($table, $from) && ! Schema::hasColumn($table, $to)) {
            DB::statement("ALTER TABLE `{$table}` CHANGE `{$from}` `{$to}` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");
        }
    }

    protected function hasForeignKey(string $table, string $constraint): bool
    {
        if (DB::getDriverName() === 'sqlite') {
            $expected = [
                'diagnostics_id_pacient_foreign' => ['from' => 'id_pacient', 'table' => 'pacients'],
                'diagnostics_id_medic_foreign' => ['from' => 'id_medic', 'table' => 'medics'],
                'cites_id_pacient_foreign' => ['from' => 'id_pacient', 'table' => 'pacients'],
                'cites_id_medic_foreign' => ['from' => 'id_medic', 'table' => 'medics'],
                'treatments_id_diagnostic_foreign' => ['from' => 'id_diagnostic', 'table' => 'diagnostics'],
                'treatments_id_medic_foreign' => ['from' => 'id_medic', 'table' => 'medics'],
                'medications_id_treatment_foreign' => ['from' => 'id_treatment', 'table' => 'treatments'],
            ][$constraint] ?? null;

            if (! $expected) {
                return false;
            }

            $foreignKeys = DB::select("PRAGMA foreign_key_list('{$table}')");

            return collect($foreignKeys)->contains(function ($foreignKey) use ($expected) {
                return $foreignKey->from === $expected['from']
                    && $foreignKey->table === $expected['table'];
            });
        }

        $database = DB::getDatabaseName();

        return DB::table('information_schema.TABLE_CONSTRAINTS')
            ->where('TABLE_SCHEMA', $database)
            ->where('TABLE_NAME', $table)
            ->where('CONSTRAINT_NAME', $constraint)
            ->exists();
    }
};
