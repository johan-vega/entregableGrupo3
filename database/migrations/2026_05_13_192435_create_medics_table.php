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
        Schema::create('medics', function (Blueprint $table) {
            $table->id('id_medic');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('especialidad');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('licencia');
            $table->integer('años_experiencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medics');
    }
};
