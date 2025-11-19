<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompteClient;
use Log;

class AjoutClientController extends Controller
{
     public function showform(){
        return view('ajoutclient');
    }
    
    public function ajoutclient(Request $request)
    {
        // Vérifie si toutes les informations sont enregister sur le formulaire
        if (
            !$request->nom ||
            !$request->prenom ||
            !$request->email ||
            !$request->adresse ||
            !$request->tel
        ) {
            return "Information manquante";
        }

        // c'est pour Créer un nouveau client
        $client = new CompteClient();

        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->email = $request->email;
        $client->adresse = $request->adresse;
        $client->numeroTel = $request->tel; // le nom de ta colonne MySQL

        // Sauvegarder le client qui vient d'etre crée dans la base
        $client->save();

        
        Log::info("Client ajouté : $client->nom $client->prenom");

        return "Client ajouté avec succès !"; 
        return view ('ajoutclient');
    }
}






?>