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
        Schema::create('food_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->comment('Nom de la catégorie (e.g., "Entrées", "Plats principaux")');
            $table->text('description')->nullable()->comment('Description facultative');
            $table->boolean('is_active')->default(true)->comment('Indique si la catégorie est active');
            $table->string('operateur')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_categories');
    }
};
