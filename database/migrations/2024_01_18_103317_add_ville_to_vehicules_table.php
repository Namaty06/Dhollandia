<?php

use App\Models\Societe;
use App\Models\Ville;
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

        Schema::table('vehicules', function (Blueprint $table) {

            $table->foreignIdFor(Societe::class)->onDelete(null);
            $table->foreignIdFor(Ville::class)->onDelete(null);

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropColumn('societe_id');
            // $table->dropColumn('marque');
            // $table->dropColumn('date_circulation');
            // $table->dropColumn('ville_id');

        });
    }
};
