<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->longText('descricao');
            $table->string('nota_fiscal');
            $table->double('valor', 8, 2);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->unsignedBigInteger('projeto_id');
            $table->foreign('projeto_id')
                ->references('id')
                ->on('projetos')
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
        Schema::dropIfExists('despesas');
    }
}
