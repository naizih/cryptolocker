<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppatFileModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'Chemin_de_fichier', 'Hash_de_fichier'
    ];
}
