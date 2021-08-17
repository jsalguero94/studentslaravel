<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion', function (Blueprint $table) {
            $table->unsignedBigInteger('Estudiantes_Id')->nullable($value = false);
            $table->unsignedBigInteger('Carreras_Id')->nullable($value = false);
            $table->string('Cursos')->nullable($value = false);
            $table->string('Jornada');
            $table->timestamps();
            $table->boolean('Active');
            $table->foreign('Estudiantes_Id')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->foreign('Carreras_Id')->references('id')->on('carreras')->onDelete('cascade');
            $table->foreign('Cursos')->references('Nombre')->on('cursos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion');
    }
}
