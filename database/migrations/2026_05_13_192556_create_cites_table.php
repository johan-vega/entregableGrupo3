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
        Schema::create('cites', function (Blueprint $table) {
            $table->id('id_cita');
            $table->dateTime('fecha');
            $table->string('motivo');

            $table->foreignId('id_pacient')->constrained('pacients', 'id_pacient')->onDelete('cascade');

            $table->foreignId('id_medic')->constrained('medics', 'id_medic')->onDelete('cascade');

            $table->string('estado');
            $table->text('observaciones')->nullable();
            $table->string('sala');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cites');
    }
};
