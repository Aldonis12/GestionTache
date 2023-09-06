<?php

namespace App\Http\Controllers;

use App\Models\Soustache;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function Restore($id)
    {
        $Tache = Tache::find($id);
        $Tache->isdeleted = 0;
        $Tache->update();

        return redirect('/Corbeille');
    }

    public function DeleteTask($id)
    {
        $Tache = Tache::find($id);
        $Tache->isdeleted = 1;
        $Tache->update();

        return redirect('/Tache');
    }    

    public function DeleteSubTask($id)
    {
        $soustache = Soustache::find($id);
        $soustache->delete();

        return redirect('/DetailsTache/'.$soustache->idtache);
    }

    public function DeleteTaskDefinitive($id)
    {
        $Tache = Tache::find($id);
        $Tache->delete();

        return redirect('/Corbeille');
    }

    public function RestoreTask($id)
    {
        $Tache = Tache::find($id);
        $Tache->isdeleted = 0;
        $Tache->update();

        return redirect('/Corbeille');
    } 

    public function RestoreAll()
    {
        /*  $Tache = Tache::all();
            foreach ($Taches as $Tache) {
            $Tache->update(['isdeleted' => 0]);
        }*/

        DB::select('update tache set isdeleted = 0 where iduser ='.session('iduser'));

        return redirect('/Corbeille');
    }

    public function DeleteAll(){
        DB::select('delete from tache where isdeleted = 1 and iduser ='.session('iduser'));
        return redirect('/Corbeille');
    }
}
