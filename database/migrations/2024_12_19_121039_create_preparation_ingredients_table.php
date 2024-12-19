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
        Schema::create('preparation_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preparation_id')->comment('Référence à la préparation');
            $table->string('ingredient_name')->comment('Nom de l\'ingrédient');
            $table->integer('quantity')->comment('Quantité de l\'ingrédient utilisé');
            $table->string('unit')->comment('Unité de mesure (e.g., "2kg", "paquets")');
            $table->foreign('preparation_id')->references('id')->on('preparations')->onDelete('cascade');
            $table->string("operateur")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preparation_ingredients');
    }
};
