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
        Schema::create('drink_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('drink_name', 150)->comment('Nom de la boisson');
            $table->integer('quantity')->comment('Quantité approvisionnée');
            $table->decimal('unit_price', 10, 2)->comment('Prix unitaire de la boisson');
            $table->decimal('total_cost', 10, 2)->comment('Coût total (calculé)');
            $table->string('operateur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink_stocks');
    }
};
