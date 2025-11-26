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
            $table->string('numero')->unique()->after('name');
            // Supprimer les colonnes email et email_verified_at
            $table->dropColumn('email_verified_at');
            $table->dropColumn('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter back les colonnes email
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // Supprimer la colonne numero
            $table->dropColumn('numero');
        });
    }
};
