<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'typeOperation',   // C, D, V
        'dateOperation',   // date de l'opération
        'montant',
        'compteDebite',
        'compteCredite',
    ];
}
