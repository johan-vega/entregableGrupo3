<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id('id_diagnostic');
            $table->text('descripcion');
            $table->dateTime('fecha');

            $table->foreignId('id_pacient')->constrained('pacients', 'id_pacient')->onDelete('cascade');
            $table->foreignId('id_medic')->constrained('medics', 'id_medic')->onDelete('cascade');

            $table->string('gravedad');
            $table->text('recomendaciones');
            $table->string('tipo_diagnostico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
