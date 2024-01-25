<?php

use App\Models\Hayon;
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
        Schema::create('hayon_vehicule', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Vehicule::class)->onDelete(null);
            $table->foreignIdFor(Hayon::class)->onDelete(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hayon_vehicule');
    }
};
