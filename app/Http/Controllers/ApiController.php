<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function login(Request $request)
{
    $mail = $request->input('mail');
    $mdp = $request->input('mdp');

    $iduser = DB::select('SELECT id FROM utilisateur WHERE email = ? and mdp = ?', [$mail, $mdp]);

    if (count($iduser) != 0) {
        session()->put('iduser', $iduser[0]->id);
        return response()->json(['message' => 'Connexion réussie', 'iduser' => $iduser[0]->id]);
    } else {
        return response()->json(['message' => 'Identifiants incorrects'], 401); // 401 signifie non autorisé
    }
}

    public function ListeTache()
    {
        $tasks = Tache::all();
        return response()->json($tasks);
    }

    public function DetailsTache($id)
    {
        $tasks = Tache::where('id',$id)->get();
        return response()->json($tasks);
    }
}
