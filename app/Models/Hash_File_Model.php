<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Hash_File_Model extends Model
{
    use HasFactory;
    protected $fillable = [
        'Chemin_de_fichier', 'Hash_de_fichier', 'nom_de_fichier', 'resultat_de_check', 'date_du_dernier_check', 'Trois_check_not_ok'
    ];
}
