<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->foreignId("curso_id")->constrained("cursos")
                    ->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("eixo_id")->constrained("eixos")
                    ->onDelete("cascade")->onUpdate("cascade");
            $table->string('nome_materia');
            $table->string('pre_req');
            $table->string('co_req');
            $table->integer('horas');
            $table->string('cat');
            $table->integer('indice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
