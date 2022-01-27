<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempsScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temps_scripts', function (Blueprint $table) {
            $table->id();  
            $table->string('temps_check');          // variable de temps pour checker le fichier.
            $table->string('temps_envoie_server_mgmt');     // variable de temps pour envoyer l'information au serveur management
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
        Schema::dropIfExists('temps_scripts');
    }
}
