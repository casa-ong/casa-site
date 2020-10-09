<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateDoacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doacaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->double('valor', 8, 2);
            $table->string('meio_pagamento');
            $table->boolean('is_anonimo');
            $table->string('comprovante_anexo');
            $table->unsignedBigInteger('conta_pagamento_id')->nullable();
            $table->foreign('conta_pagamento_id')
                  ->references('id')
                  ->on('conta_pagamentos')
                  ->onDelete('set null');
            $table->unsignedBigInteger('projeto_id')->nullable();
            $table->foreign('projeto_id')
                ->references('id')
                ->on('projetos')
                ->onDelete('set null');
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
        Schema::dropIfExists('doacaos');
    }
}
