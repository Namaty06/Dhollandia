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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrat_id')->constrained()->onDelete(null);
            $table->foreignId('status_id')->constrained()->onDelete(null);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete(null);
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->date('date_intervention');
            $table->timestamp('date_validation')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
