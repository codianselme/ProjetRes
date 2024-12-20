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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nom du plat'); // Nom du plat
            $table->text('description')->nullable()->comment('Description du plat'); // Description du plat
            $table->decimal('price', 8, 2)->comment('Prix du plat'); // Prix du plat
            // $table->unsignedBigInteger('category_id')->comment('Lien vers la catégorie du plat'); // Lien vers la catégorie du plat
            // $table->foreign('category_id')->references('id')->on('food_categories')->onDelete('cascade')->comment('Clé étrangère vers food_categories'); // Clé étrangère vers food_categories
            $table->boolean('is_available')->default(true)->comment('Statut pour savoir si le plat est disponible'); // Statut pour savoir si le plat est disponible
            $table->string('operateur')->nullable();
            $table->unsignedBigInteger('category_id')->comment('Référence à la catégorie de plat');
            // Clé étrangère vers la table dish_categories
            $table->foreign('category_id')
                ->references('id')
                ->on('dish_categories')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
