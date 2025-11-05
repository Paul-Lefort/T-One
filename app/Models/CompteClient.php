<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteClient extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function comptesBancaires()
    {
        return $this->belongsToMany(CompteBancaire::class, 'comptebancaire_compteclient', 'idClient', 'idCompteBancaire');
    }

}
