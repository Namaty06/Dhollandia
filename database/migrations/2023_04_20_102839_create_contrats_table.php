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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique()->nullable();
            $table->foreignId('societe_id')->constrained()->onDelete(null);
            $table->foreignId('vehicule_id')->constrained()->onDelete(null);
            $table->integer('intervention_chaque')->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->foreignId('status_id')->constrained()->onDelete(null);
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
