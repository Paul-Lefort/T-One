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
        Schema::table('users', function (Blueprint $table) {
            // Ajouter la colonne numero
            $table->integer('status')->after('id')->defaukt(1);
            // Supprimer les colonnes email et email_verified_at
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter back les colonnes email
            // ajouter name
            $table->string('numero')->after("id");
            $table->dropColumn('status');

        });
    }
};
