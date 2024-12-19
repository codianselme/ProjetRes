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
        Schema::create('preparations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->comment('Référence à la commande');
            $table->integer('quantity_used')->comment('Quantité d\'éléments utilisés');
            $table->string('ingredients')->comment('Ingrédients utilisés');
            $table->boolean('is_completed')->default(false)->comment('Statut de la préparation');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preparations');
    }
};
