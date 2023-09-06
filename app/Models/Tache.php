<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'tache';
    
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['idcolor','iduser','tache','statut','isdeleted','datelimite','dateterminer','idpriority',
    'inserted'];

    public function color(){
        return $this->belongsTo(Color::class, 'idcolor');
    }

    public function user(){
        return $this->belongsTo(Utilisateur::class, 'iduser');
    }

    public function stat(){
        return $this->belongsTo(Statut::class, 'statut');
    }

    public function priority(){
        return $this->belongsTo(Priority::class, 'idpriority');
    }
}
