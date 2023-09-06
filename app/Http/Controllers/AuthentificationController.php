<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthentificationController extends Controller
{
    public function Login(Request $request)
    {
        $mail = $request->input('mail');
        $mdp = $request->input('mdp');

        $iduser = DB::select('SELECT id FROM utilisateur WHERE email = ? and mdp = ?', [$mail, $mdp]);

        if(count($iduser) != 0){
            session()->put('iduser', $iduser[0]->id);
            return redirect('/Tache');

        } else if(count($iduser) == 0){
            return redirect()->back()->with('error', 'error');
        }
    }

    public function Logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function SignIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'mail' => 'required|email',
            'mdp' => 'required|min:6',
            'confirmemdp' => 'required|same:mdp',
        ], [
            'nom.required' => 'Le champ nom est requis.',
            'mail.required' => 'Le champ email est requis.',
            'mail.email' => 'Veuillez entrer une adresse email valide.',
            'mdp.required' => 'Le champ mot de passe est requis.',
            'mdp.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'confirmemdp.required' => 'Le champ de confirmation du mot de passe est requis.',
            'confirmemdp.same' => 'La confirmation du mot de passe ne correspond pas au mot de passe saisi.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new Utilisateur();
        $user->nom = $request->nom;
        $user->email = $request->mail;
        $user->mdp = $request->mdp;
        $user->save();

        return redirect()->back()->with('validate', 'Ajouter avec succès.');
    }

    public function checkEmail(Request $request) {
        $email = $request->get('email');
        $user = Utilisateur::where('email', $email)->first();
        return response()->json(['exists' => $user !== null]);
    }

    public function changeLanguage(Request $request)
    {
        $language = $request->input('language');
        session(['locale' => $language]);
        return back();
    }
}
