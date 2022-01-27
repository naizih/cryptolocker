<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temps_script extends Model
{
    use HasFactory;
    protected $fillable = [
        'temps_check', 'temps_envoie_server_mgmt'
    ];
}
