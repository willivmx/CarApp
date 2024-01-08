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
        Schema::create('automobile', function (Blueprint $table) {
            $table->id();
            $table->time('heure_arrivé');
            $table->string('numéro_plaque_matriculation');
            $table->string('type');
            $table->string('couleur');
            $table->string('emplacement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automobile');
    }
};
