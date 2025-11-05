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
        Schema::create('comptebancaire_compteclient', function (Blueprint $table) {
            $table->unsignedBigInteger( 'idClient' );
            $table->foreign('idClient')
                  ->references( 'id' )  
                  ->on('compte_clients')
                  ->onDelete( 'cascade' );

            $table->unsignedBigInteger( 'idCompteBancaire' );
            $table->foreign( 'idCompteBancaire' )
                  ->references( 'id' )
                  ->on( 'compte_bancaires' )
                  ->onDelete( 'cascade' );

            $table->primary( [ 'idClient', 'idCompteBancaire' ] );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptebancaire_compteclient');
    }
};
