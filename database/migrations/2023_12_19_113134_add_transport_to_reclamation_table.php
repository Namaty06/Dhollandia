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
        Schema::table('reclamations', function (Blueprint $table) {
            // $table->foreign('transport_id')->references('id')->on('vehicules');
            $table->foreignId('transport_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reclamation', function (Blueprint $table) {
            //
        });
    }
};
