<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'color';
    
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['nom','color'];
}
