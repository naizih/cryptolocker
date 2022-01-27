<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Srv_partage extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'utilisateur',
        'dossier_partager',
        'partage_monter',
        'password'
    ];
}
