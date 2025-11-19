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
        Schema::create('compte_clients', function (Blueprint $table) {
            $table->id();


            $table->string( 'nom' );
            $table->string( 'prenom' );
            $table->string( 'adresse' );
            $table->integer( 'numeroTel' );
            $table->string( 'email' );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compte_clients');
    }
};
