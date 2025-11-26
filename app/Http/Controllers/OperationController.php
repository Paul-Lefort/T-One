<?php

namespace App\Http\Controllers;

use App\Models\CompteBancaire;
use App\Models\Operation;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class OperationController extends Controller
{

    public function getOperation($idCompte, $typeOperation = null){

        try {

            $query = DB::table('operations')
                ->where(function ($query) use ($idCompte) {
                    $query->where('compteDebite', $idCompte)
                        ->orWhere('compteCredite', $idCompte);
                });

            if ($typeOperation) {
                $query->where('typeOperation', $typeOperation);
            }

            $operations = $query
                ->orderBy('dateOperation', 'desc')
                ->limit(200) 
                ->get();

            Log::info("Résumé de l'historique du compte : $idCompte récupéré", [
                'nombre_operations' => $operations->count()
            ]);

                return view('historique', compact('operations'));

        } catch (\Throwable $th) {
            Log::error("Erreur lors de la récupération de l'historique", [
                'idCompte' => $idCompte,
                'message' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);

            return back()->with('error', 'Une erreur est survenue lors de la récupération de l\'historique');
        }

    }
    
    public function credit($somme, $idCompteACrediter){
        //on vérifie que la somme est supérieur à 0.
        if($somme <= 0){
            return "La somme ne peux pas être négative";
        }

        //on charge le compte Bancaire à crédité
        $compteACrediter = CompteBancaire::find($idCompteACrediter);

        //si le compte n'existe pas on génère des logs + message d'erreur.
        if (!$compteACrediter){
            Log::error( "credit sur un compte existent id : ". $idCompteACrediter );
            return "Compte inconnu";
        }

        try {

            //On commence la transaction.
            DB::transaction(function () use($somme, $compteACrediter){
                $compteACrediter->solde += $somme;
                $compteACrediter->save();

                Operation::create([
                'typeOperation' => 'C',
                'dateOperation' => now(),
                'montant' => $somme,
                'compteDebite' => null,
                'compteCredite' => $compteACrediter->id,
                ]);
                
            });
            //log + message de réussite.
            Log::info('Ceci est un message d\'info');
            return "Opération réussite";


        } catch (\Throwable $th) {
            Log::error("Erreur lors du crédit", [
            'idCompte' => $idCompteACrediter,
            'montant' => $somme,
            'message' => $th->getMessage(),
            'trace' => $th->getTraceAsString()
            ]);

            return "une erreur est survenu";
        }
    }
    
    public function debit($somme, $idCompteADebiter){

        //on charge le compte à debiter
        $compteADebiter = CompteBancaire::find($idCompteADebiter);

        //si le compte n'existe pas log + message d'erreur
        if (!$compteADebiter){
            Log::error( "credit sur un compte existent id : ". $idCompteADebiter );
            return "Compte inconnu";
        }

        try {
            //on commence la transaction.
            DB::transaction(function () use($somme, $compteADebiter){
                $compteADebiter->solde -= $somme;
                $compteADebiter->save();

                Operation::create([
                'typeOperation' => 'D',
                'dateOperation' => now(),
                'montant' => $somme,
                'compteDebite' => $compteADebiter->id,
                'compteCredite' => null,
                ]);
            });

            //log + message de reussite.
            Log::info('Ceci est un message d\'info');
            return "Opération réussite";


        } catch (\Throwable $th) {
            //en cas de probleme log + message d'erreur.

            Log::error("Erreur lors du débit", [
            'idCompte' => $idCompteADebiter,
            'montant' => $somme,
            'message' => $th->getMessage(),
            'trace' => $th->getTraceAsString()
            ]);

            return "une erreur est survenu";
        }

    }

    public function virement($somme, $idCompteADebiter, $idCompteACrediter){
        
        //on charge les deux comptes bancaires.
        $compteADebiter = CompteBancaire::find($idCompteADebiter);
        $compteACrediter = CompteBancaire::find($idCompteACrediter);

        //on s'assure que les deux sont charger et existe.
        if (!$compteACrediter || !$compteADebiter){
            Log::error( "credit sur un compte existent id : ". $idCompteACrediter. " ou ". $idCompteADebiter);
            return "un des comptes n'existe pas.";
        }

        // on verifie si le compte à debiter a bien les fonds.
        $soldeCompteADebiteur = $compteADebiter->solde;
        if ($soldeCompteADebiteur < $somme){
            Log::error( "Solde du compte debiteur : ". $idCompteADebiter. " est insuffisent");
            return "solde du compte insuffisent";
        }

        try {
            //Debut de la transaction.
            DB::transaction(function () use ($somme, $compteACrediter, $compteADebiter){
                $compteADebiter->solde -= $somme;
                $compteADebiter->save();

                $compteACrediter->solde += $somme;
                $compteACrediter->save();

                Operation::create([
                'typeOperation' => 'V',
                'dateOperation' => now(),
                'montant' => $somme,
                'compteDebite' => $compteADebiter->id,
                'compteCredite' => $compteACrediter->id,
                ]);

            });
            //log + message de reussite.
            Log::info('Ceci est un message d\'info');
            return "Opération réussite";

        }
        catch (\Throwable $th) {

            //log + message d'erreur.
            Log::error("Erreur lors du crédit", [
            'idCompteDebiteur' => $idCompteADebiter,
            'idCompteCrediteur' => $idCompteACrediter,
            'montant' => $somme,
            'message' => $th->getMessage(),
            'trace' => $th->getTraceAsString()
            ]);

            return "une erreur est survenu";
        }
    }

}
