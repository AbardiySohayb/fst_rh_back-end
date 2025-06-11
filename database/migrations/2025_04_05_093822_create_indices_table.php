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
        Schema::create('indices', function (Blueprint $table) {
            $table->integer('idIndice');
            $table->string('Description')->nullable();
            $table->string('idCategorie');
            $table->string('idGrade');
            $table->string('idEchlant');
            $table->timestamps();

            // Clé primaire composée
            $table->primary(['idIndice', 'idCategorie', 'idGrade', 'idEchlant']);

            // Clés étrangères
            $table->foreign('idCategorie')->references('idCategorie')->on('categories')->onDelete('cascade');
            $table->foreign('idGrade')->references('idGrade')->on('grades')->onDelete('cascade');
            $table->foreign('idEchlant')->references('idEchlant')->on('echlants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indices');
    }
};
