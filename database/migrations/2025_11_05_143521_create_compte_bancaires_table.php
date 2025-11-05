<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compte_bancaires', function (Blueprint $table) {
            $table->id(); 
            
            $table->unsignedBigInteger('numeroClient'); 
            $table->integer('montant');
            $table->string('typeDeCompte');
            $table->date('dateOuverture'); 
            
            $table->foreign('numeroClient')
                  ->references('id')
                  ->on('compte_clients')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compte_bancaires');
    }
};
