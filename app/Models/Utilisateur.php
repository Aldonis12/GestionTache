<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'utilisateur';
    
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['nom','email','mdp'];
}
