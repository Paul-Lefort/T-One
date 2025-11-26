<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompteClient;

class PasswordChangeController extends Controller
{
    public function ChangePassword($idAccount, $pwd, $newPwd){
        if (!$idAccount) {
                Log::error("Utilisation de informationCompte sans ID");
                return "ID manquant";
            }
        }
    
}

?>