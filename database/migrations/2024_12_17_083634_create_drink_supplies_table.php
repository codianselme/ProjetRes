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
        Schema::create('drink_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('drink_name', 150)->comment('Nom de la boisson');
            $table->string('unit', 50)->comment('Unité de mesure (e.g., "litres", "bouteilles")');
            $table->string('supplier_name', 150)->comment('Nom du fournisseur');
            $table->integer('quantity')->comment('Quantité approvisionnée');
            $table->decimal('unit_price', 10, 2)->comment('Prix unitaire de la boisson');
            $table->decimal('total_cost', 10, 2)->comment('Coût total (calculé)');
            $table->date('supply_date')->comment('Date d\'approvisionnement');

            $table->unsignedBigInteger('category_id')->comment('Référence à la catégorie de boisson');
            // Clé étrangère vers la table drink_categories
            $table->foreign('category_id')
                ->references('id')
                ->on('drink_categories')
                ->onDelete('cascade');
            
            $table->string('operateur')->nullable();
            $table->softDeletes();
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink_supplies');
    }
};
