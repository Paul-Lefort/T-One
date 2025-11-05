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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();

            $table->String( 'typeOperation' );

            $table->dateTime('dateOuverture');

            $table->decimal('solde', 15, 2);
            
            $table->unsignedBigInteger( 'compteDebite' );
            $table->foreign( 'compteDebite' )
                  ->references('id')
                  ->on('compte_bancaires')
                  ->onDelete( 'cascade' );

            $table->unsignedBigInteger( 'compteCredite' );
            $table->foreign( 'compteCredite' )
                  ->references('id')
                  ->on('compte_bancaires')
                  ->onDelete( 'cascade' );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
