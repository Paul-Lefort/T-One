<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteBancaire extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function clients()
    {
        return $this->belongsToMany(CompteClient::class, 'comptebancaire_compteclient', 'idCompteBancaire', 'idClient');
    }

}
