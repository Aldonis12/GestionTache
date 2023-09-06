<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Soustache extends Model
{
    protected $table = 'soustache';
    
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['idtache','soustache','datelimite','idpriority','statut',
    'inserted'];

    public function tache(){
        return $this->belongsTo(Tache::class, 'idtache');
    }

    public function stat(){
        return $this->belongsTo(Statut::class, 'statut');
    }

    public function priority(){
        return $this->belongsTo(Priority::class, 'idpriority');
    }


    public function CheckStatut($idTache){
        $check = DB::select('select statut from soustache where idtache= '.$idTache);
        $intMisy = 0;
        $intTsisy = 0;

        for($i=0;$i<count($check);$i++){
            if ($check[$i]->statut<3) {
                $intMisy ++;
            }else if($check[$i]->statut=3){
                $intTsisy++;
            }
        }

        if ($intMisy==0 && $intTsisy>0) {
           return 0;
        }
        if ($intMisy > 0) {
            return 1;
        }
    }

    public function GetDateMax($idTache){
        $date = DB::select('Select datelimite from soustache where datelimite = (select MAX(datelimite) from soustache) and idtache='.$idTache);
        if (!empty($date)) {
            $datelimite = $date[0]->datelimite;
        } else {
            $datelimite = null;
        }
        return $datelimite;
    }
}