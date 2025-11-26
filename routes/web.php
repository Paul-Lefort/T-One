<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/account/view/{idAccount}', function ($idAccount) {
    return ('Vous visionnez le compte numéro : '. $idAccount);
}) -> where('idAccount', '[0-9]+');


Route::get('/account/{action}/{amount}/{idCompte}', function ($action, $amount, $idCompte) {

    $operationController = new OperationController();

    switch ($action) {
        case 'credit':
            return $operationController->credit($amount, $idCompte);
        case 'debit':
            return $operationController->debit($amount, $idCompte);
        default:
            return "Action invalide. Utilisez 'credit' ou 'debit'.";
    }

})->where([
    'action' => 'credit|debit|virement',
    'amount' => '[0-9]+',
    'idCompte' => '[0-9]+'
]);

Route::get('/account/virement/{amount}/{idCompteSource}/{idCompteDest}', function ($somme, $idCompteADebiter, $idCompteACrediter) {

    $operationController = new OperationController();
    // Assurez-vous d'avoir une méthode 'transfert' dans OperationController
    return $operationController->virement($somme, $idCompteADebiter, $idCompteACrediter);

})->where([
    'amount' => '[0-9]+',
    'idCompteSource' => '[0-9]+',
    'idCompteDest' => '[0-9]+'
]);

Route::get('/operations/{idCompte}/{typeOperation?}', [OperationController::class, 'getOperation']);


Route::get('/account/virement/{idAccount}', function ($idAccount = NULL) {
    //le virement concerne deux personnes on met juste l'id de la personne 
    return ('vous allez faire un virement vers le compte : '. $idAccount);
}) -> where('idAccount', '[0-9]+');


Route::get('/account/profile', function () {
    return ('welcome');
});

Route::get('/account/changePassword', function () {
    return ('welcome');
});

Route::get('/manage/{action}/{idAccount}', function ($action = NULL, $idAccount = NULL) {
    //action : regarder un compte, gele un compte ou le degeler
    //idAccount : cible un compte en particulier
    return ('Vous allez effectuer un "'. $action .'" sur le compte : '.$idAccount);
})->where([
    'action' => 'view|freeze|unfreeze',
    'idAccount' => '[0-9]+'
]);

Route::get('/manage/reviewLoan/{idClient}', function ($idClient) {
    return ('Voici la simulation de pret pour le client : '. $idClient);
}) -> where('idClient', '[0-9]+');


Route::get('/manage/ClientFolder/{action}', function () {
    //action : view (visionnage dossier client), create (creer un nouveau dossier client)
    return ('vous allez creer ou visionnez un dossier client');
})->where(['action' => 'view|create|']);

Route::get('/admin/{action}/{idUser}', function ($action = NULL, $idUser = NULL) {
    //action : gestion des acces (bloquer/debloquer, creer, supprimer)
    //idUser : id propre a chaque compte que ce soit client ou staff
    return ("vous allez effectuer l'action de ". $action . ' sur le compte '. $idUser);
})->where([
    'action' => 'lock|unlock|block|unblock|create|delete',
    'idUser' => '[0-9]+'
]);

Route::get('/flux/{action}', function ($action = NULL) {
    //affiche une liste de toute les actions (credit, depot, virement)
    return ('vous allez visionner le flux des : '. $action);
})->where(['action' => 'credit|depot|virement']);

Route::get('/manage/viewAlerts', function () {
    return view('welcome');
});
