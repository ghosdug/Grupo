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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('periodo', 5);
            $table->string('materia')->nullable(); // IMPORTANTE: nullable()
            $table->string('rfc', 13);
            $table->integer('alumno_escritos')->default(0);
            $table->string('grupo', 255);
            $table->string('estatus_grupo', 50);
            $table->integer('capacidad_grupo');
            $table->string('tipo_personal')->nullable();
            $table->string('folio_acta')->nullable();
            $table->string('paralelo_de')->nullable();
            $table->string('exclusivo_carrera')->nullable();
            $table->string('exclusivo_reticula')->nullable();
            $table->timestamps();

            // Índices para mejorar el rendimiento
            $table->index('periodo');
            $table->index('rfc');
            $table->index('estatus_grupo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};