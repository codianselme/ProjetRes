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
        Schema::create('food_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('food_name', 150)->comment('Nom de l\'aliment');
            $table->string('unit', 50)->comment('Unité de mesure (e.g., "kg", "paquets")');
            $table->string('supplier_name', 150)->comment('Nom du fournisseur');
            $table->integer('quantity')->comment('Quantité approvisionnée');
            $table->decimal('unit_price', 10, 2)->comment('Prix unitaire de l\'aliment');
            $table->decimal('total_cost', 10, 2)->comment('Coût total (calculé)');
            $table->date('supply_date')->comment('Date d\'approvisionnement');

            $table->unsignedBigInteger('category_id')->comment('Référence à la catégorie d\'aliment');
            // Clé étrangère vers la table food_categories
            $table->foreign('category_id')
                ->references('id')
                ->on('food_categories')
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_supplies');
    }
};
