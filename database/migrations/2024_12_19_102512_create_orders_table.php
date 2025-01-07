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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Référence à l\'utilisateur qui a passé la commande');
            $table->unsignedBigInteger('dish_id')->comment('Référence au plat commandé');
            $table->string('client_number')->comment('Numéro de client');
            $table->integer('quantity')->comment('Quantité commandée');
            $table->string('status')->default('pending')->comment('Statut de la commande');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
            $table->string('operateur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
