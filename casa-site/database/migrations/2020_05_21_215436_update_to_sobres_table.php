<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateToSobresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sobres', function (Blueprint $table) {
            $table->string('titulo_site')->nullable()->change();
            $table->string('logo')->nullable()->change();
            $table->string('slogan')->nullable()->change();
            $table->longText('texto_sobre')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sobres', function (Blueprint $table) {
            //
        });
    }
}
