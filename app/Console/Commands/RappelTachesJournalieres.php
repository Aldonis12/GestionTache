<?php

namespace App\Console\Commands;

use App\Http\Controllers\AuthentificationController;
use App\Models\Soustache;
use App\Models\Tache;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Console\Command;
use Carbon\Carbon;

class RappelTachesJournalieres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rappel:taches-journalieres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoyer des rappels pour les tâches d\'aujourd\'hui';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateAujourdhui = Carbon::today();
        $user = Utilisateur::all();
        foreach ($user as $users) {
            $taches = Tache::whereDate('datelimite', '=', $dateAujourdhui->format('Y-m-d'))->where('isdeleted', 0)->where('iduser', $users->id)->orderBy('inserted', 'desc')->get();

            if ($taches->isNotEmpty()) {
                $subject = "Rappel pour les tâches d'aujourd'hui";
                $message = "Voici vos tâches pour aujourd'hui : \n";

                foreach ($taches as $tache) {
                    $message .= "- {$tache->tache}\n";
                }

                $Auth = new AuthentificationController();
                $Auth->sendEmail($subject, $message,$users->email,$users->nom);
            }
        }
    }
}
