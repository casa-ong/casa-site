<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsToSobresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sobres', function (Blueprint $table) {
            $table->dropColumn('slogan');
            $table->dropColumn('anexo_sobre');
            $table->dropColumn('telefone');
            $table->dropColumn('email');
            $table->dropColumn('instagram');
            $table->dropColumn('twitter');
            $table->dropColumn('facebook');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sobre', function (Blueprint $table) {
            //
        });
    }
}
