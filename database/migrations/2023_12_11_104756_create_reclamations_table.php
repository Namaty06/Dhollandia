<?php

use App\Models\Societe;
use App\Models\Status;
use App\Models\User;
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
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->foreignIdFor(Societe::class)->onDelete(null);
            $table->foreignIdFor(Vehicule::class)->onDelete(null);
            $table->foreignIdFor(User::class)->onDelete(null);
            $table->foreignIdFor(Status::class)->onDelete(null);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamations');
    }
};
