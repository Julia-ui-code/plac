<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")
                    ->onDelete("cascade")->onUpdate("cascade");
            $table->integer('periodo_id');
            $table->string('fazer')->nullable();
            $table->string('concluido')->nullable();
            $table->string('estagio')->nullable();
            $table->string('ativs')->nullable();
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
        Schema::dropIfExists('materia_users');
    }
}
