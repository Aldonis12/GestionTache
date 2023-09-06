<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Soustache;
use App\Models\Statut;
use App\Models\Tache;
use App\Models\Utilisateur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function ModifierTache(Request $request)
    {
        $tache = Tache::find($request->id);
        $tache->tache = $request->tache;
        $tache->statut = $request->statut;
        $tache->idcolor = $request->color;
        $tache->idpriority = $request->priority;       
        $tache->datelimite = $request->datelimite;       
        $tache->update();

        return redirect('/DetailsTache/'.$tache->id);
    }

    public function PageModifierSousTache($id)
    {
        $user = Utilisateur::find(session('iduser'));
        $statuts = Statut::all();
        $soustache = Soustache::find($id);
        $priorities = Priority::all();
        $url = "ConfirmeModifierSousTache";
        $titre = "subtask";
        return view('update',compact('url','titre','priorities','soustache','statuts','user')); 
    }

    public function ModifierSousTache(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'soustache' => 'required',
        ], [
            'soustache.required' => 'Le champ sous-tache est requis.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $soustache = Soustache::find( $request->idtache);
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

        $Today = Carbon::now();

        $soustaches = new Soustache();
        if($soustaches->CheckStatut($soustache->idtache)==0){
            DB::select('update tache set statut = 3 where id ='.$soustache->idtache);
            DB::select("update tache set dateterminer = '".$Today->format('Y-m-d H:i:s')."' where id =".$soustache->idtache);
        }

        if($soustaches->CheckStatut($soustache->idtache)==1){
            DB::select('update tache set statut = 2 where id ='.$soustache->idtache);
            DB::select('update tache set dateterminer = null where id ='.$soustache->idtache);
        }
        
        return redirect('/DetailsTache/'.$soustache->idtache);
    }
    
    public function ModifierUtilisateur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nom' => 'required',
            'mail' => 'required',
        ], [
            'nom.required' => 'Le champ nom est requis.',
            'id.required' => 'ID requis.',
            'mail.required' => 'Le champ mail est requis.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $User = Utilisateur::find($request->id);
        $User->nom = $request->nom;
        $User->email = $request->mail;
        $User->update();

        return redirect('/Parametre');
    }

    public function checkEmailForUpdate(Request $request) {
        $email = $request->get('email');
        $utilisateur = Utilisateur::find(session('iduser'));
        $user = Utilisateur::where('email', $email)
            ->where('id', '!=', $utilisateur->id)
            ->first();
        return response()->json(['exists' => $user !== null]);
    }

    public function checkPasswordForUpdate(Request $request) {
        $mdp = $request->get('password');
        $user = Utilisateur::where('id',session('iduser'))->where('mdp', $mdp)->first();
        return response()->json(['exists' => $user !== null]);
    }

    public function ModifierUtilisateurMDP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'mdp' => 'required',
            'nouveau' => 'required',
            'confirmer' => 'required',
        ], [
            'mdp.required' => 'Le champ mdp est requis.',
            'id.required' => 'ID requis.',
            'nouveau.required' => 'Le champ nouveau est requis.',
            'confirmer.required' => 'Le champ confirmer est requis.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $User = Utilisateur::find($request->id);
        $User->mdp = $request->nouveau;
        $User->update();

        return redirect('/Parametre');
    }
}
