<?php

use App\Models\Societe;
use App\Models\Status;
use App\Models\Vehicule;
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
        Schema::create('vehicules_contrat', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Vehicule::class)->onDelete(null);
            $table->foreignIdFor(Status::class)->onDelete(null);
            $table->foreignIdFor(Societe::class)->onDelete(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules_contrat');
    }
};
