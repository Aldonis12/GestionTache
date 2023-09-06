<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Priority;
use App\Models\Soustache;
use App\Models\Statut;
use App\Models\Tache;
use App\Models\Utilisateur;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function RechercheTache(Request $request)
    {
        $user = Utilisateur::find(session('iduser'));

        $query = Tache::where('isdeleted', 0)->where('iduser', session('iduser'))
        ->where(function ($query) use ($request) {
            $query->where('tache', 'LIKE', '%' . $request->search . '%');
        })
        ->orderBy('idpriority')
        ->orderBy('inserted', 'desc');

        if ($request->statut > 0) {
            $query->where('statut', $request->statut);
        }

        $taches = $query->get();

        $var = "tache";
        $statuts = Statut::all();
        $recherche ="recherche";
        $titre = "tasklist";
        $tittle = "todolist";
        return view('liste',compact('taches','var','user','titre','statuts','recherche','tittle'));
    }

    public function ListeTache()
    {
        $user = Utilisateur::find(session('iduser'));
        $taches = Tache::where('isdeleted', 0)->where('iduser',session('iduser'))->orderBy('idpriority')->orderBy('inserted', 'desc')->get();
        $var = "tache";
        $titre = "tasklist";
        $recherche ="recherche";
        $statuts = Statut::all();
        $tittle = "todolist";
        return view('liste',compact('taches','var','user','titre','statuts','recherche','tittle'));
    }

    public function ListeTacheToday()
    {
        $dateAujourdhui = Carbon::today();
        $user = Utilisateur::find(session('iduser'));
        $taches = Tache::whereDate('datelimite', '=', $dateAujourdhui->format('Y-m-d'))->where('isdeleted', 0)->where('iduser',session('iduser'))->orderBy('inserted', 'desc')->get();
        $var = "tache";
        $titre = "tasklisttoday";
        $tittle = "todaylist";
        /*$sql = $taches->toSql();
        echo($sql);*/
        return view('liste',compact('taches','var','user','titre','tittle'));
    }

    public function DetailsTache($idtache){
        $statuts = Statut::all();
        $user = Utilisateur::find(session('iduser'));
        $tache = Tache::find($idtache);
        $colors = Color::all();
        $priorities = Priority::all();
        $soustaches = Soustache::where('idtache',$idtache)->orderBy('idpriority')->orderBy('inserted', 'desc')->get();
        $var = "detailstache";
        $tittle = "detail";
        return view('liste',compact('tache','var','soustaches','user','statuts','colors','priorities','tittle'));
    }

    public function Corbeille()
    {
        $user = Utilisateur::find(session('iduser'));
        $taches = Tache::where('isdeleted', 1)->where('iduser',session('iduser'))->get();
        $var = "corbeille";
        $tittle = "recycle";
        return view('liste',compact('taches','var','user','tittle'));
    }

    public function Parametre()
    {
        $user = Utilisateur::find(session('iduser'));
        $tittle = "settings";
        $var = "parametre";
        return view('liste',compact('var','user','tittle'));
    }
}
