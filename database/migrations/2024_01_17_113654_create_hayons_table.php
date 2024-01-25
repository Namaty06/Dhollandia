<?php

use App\Models\TypeHayon;
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
        Schema::create('hayons', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->string('pdf')->nullable();
            $table->foreignIdFor(TypeHayon::class)->onDelete(null);
            $table->foreignIdFor(Vehicule::class)->onDelete(null);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hayons');
    }
};
