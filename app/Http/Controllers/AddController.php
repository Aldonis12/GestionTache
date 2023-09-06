<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Soustache;
use App\Models\Statut;
use App\Models\Tache;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AddController extends Controller
{
    public function PageAjoutTache()
    {
        $user = Utilisateur::find(session('iduser'));
        $priorities = Priority::all();
        $url = "ConfirmeAjoutTache";
        $titre = "addtask";
        return view('ajout',compact('url','titre','priorities','user')); 
    }

    public function AjoutTache(Request $request)
    {
        $iduser = session('iduser');
        $validator = Validator::make($request->all(), [
            'tache' => 'required',
        ], [
            'tache.required' => 'Le champ tache est requis.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tache = new Tache();
        $tache->iduser = $iduser;
        $tache->tache = $request->tache;
        if($request->priority>0){
        $tache->idpriority = $request->priority;
        }else{
            $tache->idpriority = 3;
        }
        if($request->datelimite!=null){
            $tache->datelimite = $request->datelimite;
        }
        $tache->save();

        return redirect('/PageAjoutTache');
    }

    public function PageAjoutSousTache($id)
    {
        $user = Utilisateur::find(session('iduser'));
        $statuts = Statut::all();
        $tache = Tache::find($id);
        $priorities = Priority::all();
        $url = "ConfirmeAjoutSousTache";
        $titre = "addsubtask";
        return view('ajout',compact('url','titre','priorities','tache','statuts','user')); 
    }

    public function AjoutSousTache(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'soustache' => 'required',
        ], [
            'soustache.required' => 'Le champ sous-tache est requis.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $soustache = new Soustache();
        $soustache->idtache = $request->idtache;
        $soustache->soustache = $request->soustache;
        if($request->statut>0){
        $soustache->statut = $request->statut;
        }else{
            $soustache->statut = 2;
        }
        if($request->priority>0){
            $soustache->idpriority = $request->priority;
            }else{
                $soustache->idpriority = 3;
            }
        if($request->datelimite!=null){
            $soustache->datelimite = $request->datelimite;
        }
        $soustache->save();

        return redirect('/DetailsTache/'.$request->idtache);
    }
}
