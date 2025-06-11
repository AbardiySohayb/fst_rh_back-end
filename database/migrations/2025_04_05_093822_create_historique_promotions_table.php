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
        Schema::create('historique_promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // ou autre identifiant selon l’utilisateur
            $table->string('action'); // passage, promotion, refus
            $table->string('ancien_grade')->nullable();
            $table->string('nouveau_grade')->nullable();
            $table->date('date_action');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_promotions');
    }
};
