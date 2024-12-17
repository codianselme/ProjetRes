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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique()->comment('Numéro unique de la facture');
            $table->decimal('total_amount', 10, 2)->comment('Montant total de la vente');
            $table->decimal('paid_amount', 10, 2)->comment('Montant payé');
            $table->string('payment_method')->default('cash')->comment('Méthode de paiement utilisée');
            $table->string('status')->default('completed')->comment('État de la vente');
            $table->text('notes')->nullable()->comment('Notes supplémentaires sur la vente');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
