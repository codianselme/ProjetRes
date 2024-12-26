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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            
            // $table->morphs('itemable')->comment('Pour les plats et boissons');
            // $table->integer('quantity')->comment('Quantité');
            // $table->decimal('unit_price', 10, 2)->comment('Prix unitaire');
            // $table->decimal('total_price', 10, 2)->comment('Prix total');
            // $table->foreignId('sale_id')->constrained()->onDelete('cascade');
            // $table->timestamps();

            $table->unsignedBigInteger('itemable_id')->comment('ID de l\'élément (plat ou boisson)');
            $table->string('itemable_type')->comment('Type de l\'élément (App\\Models\\Dish ou App\\Models\\Drink)');
            $table->integer('quantity')->comment('Quantité');
            $table->decimal('unit_price', 10, 2)->comment('Prix unitaire');
            $table->decimal('total_price', 10, 2)->comment('Prix total');
            $table->foreignId('sale_id')->constrained()->onDelete('cascade')->comment('Référence à la vente');
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
        Schema::dropIfExists('sale_items');
    }
};
