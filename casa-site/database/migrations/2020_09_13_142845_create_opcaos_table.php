<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('foto')->nullable();
            $table->integer('votos')->nullable();
            $table->unsignedBigInteger('enquete_id');
            $table->foreign('enquete_id')
                ->references('id')
                ->on('enquetes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('opcaos');
    }
}
