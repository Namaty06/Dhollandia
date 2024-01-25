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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('numero_serie')->unique();
            $table->string('matricule')->nullable();
            // $table->string('marque')->nullable();
            // $table->date('date_circulation')->nullable();
            $table->double('capacite')->nullable();
            $table->string('image')->nullable();
            // $table->boolean('status')->default(false);
            $table->foreignId('typevehicule_id')->constrained('type_vehicules')->onDelete(null);
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
