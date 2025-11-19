<?php

namespace App\Http\Controllers;

use App\Models\CompteClient;
use Log;

class ClientController extends Controller
{
   
    public function informationCompte($idAccount)
    {
        // verifie si il y a des information
        if (!$idAccount) {
            Log::error("Utilisation de informationCompte sans ID");
            return "ID manquant";
        }

        // trie les information qu'on souhaite
        $client = CompteClient::select('nom', 'prenom' , 'numeroTel' , 'email', 'adresse')
        ->find($idAccount);


        //verifie si il y a un client associer la l'idaccount
        if (!$client) {
            Log::error("Client introuvable : $idAccount");
            return "Client introuvable";
        }

        
        Log::info("Récupération des informations de $client->nom $client->prenom");

        
        return $client;
    }
}


?>