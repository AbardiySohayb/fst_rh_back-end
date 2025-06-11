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
        Schema::create('employes', function (Blueprint $table) {
            $table->id(); // clé primaire auto-incrémentée
            $table->string('nom');
            $table->string('prenom');
            $table->date('dateNaissance');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('departement');
            $table->string('poste');
            $table->date('dateDeRecrutement');
            $table->date('dateDeGrade')->nullable();
            $table->date('AncienneteEchelon')->nullable();
            $table->string('typeContrat');
            $table->string('statut');
            $table->string('photo')->nullable();
            $table->json('diplomes')->nullable();
            $table->json('competences')->nullable();
            $table->json('soldeConges')->nullable();

            // Relations
            $table->string('idCategorie');
            $table->string('idGrade');
            $table->string('idEchlant');

            // Clés étrangères
            $table->foreign('idCategorie')->references('idCategorie')->on('categories')->onDelete('cascade');
            $table->foreign('idGrade')->references('idGrade')->on('grades')->onDelete('cascade');
            $table->foreign('idEchlant')->references('idEchlant')->on('echlants')->onDelete('cascade');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
