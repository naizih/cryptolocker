<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class info_serveur_mgmt extends Model
{
    use HasFactory;
    protected $fillable = [
        'IP_DNS', 'port'
    ];
}
