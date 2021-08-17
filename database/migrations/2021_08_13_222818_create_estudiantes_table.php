<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('Nombres');
            $table->string('Apellidos');
            $table->string('Tipo_Identificacion');
            $table->integer('No_Identificacion')->unique();
            $table->string('Sexo',2);
            $table->date('Fecha_Nacimiento');
            $table->timestamps();
            $table->boolean('Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
