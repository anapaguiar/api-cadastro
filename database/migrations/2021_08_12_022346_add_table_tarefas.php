<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableTarefas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->tinyInteger('status');
            $table->unsignedInteger('id_usuario');

            $table->foreign('id_usuario')
            ->references('id')
            ->on('usuarios')->onDelete('cascade');
            
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
        Schema::dropIfExists('tarefas');
    }
}
