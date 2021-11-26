<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//class HashFileModel extends Migration

class HashFileModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hash__file__models', function (Blueprint $table) {
            $table->id();
            $table->string('nom_de_fichier');
            $table->string('Chemin_de_fichier');
            $table->string('Hash_de_fichier');
            $table->timestamps();
            //pour aller plus loin on peur sauvgarder un copier de chaque fichier appat dans le serveur client
            //pour aller plus loin il faut sauvgarder nom_de_technicien, @IP, lien_de_fichier_dans_le_serveur, ....
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hash__file__models');
    }
}
