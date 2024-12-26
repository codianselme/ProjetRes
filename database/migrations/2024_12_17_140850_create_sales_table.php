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
            $table->string('payment_method')->comment('Méthode de paiement utilisée');
            $table->string('status')->default('completed')->comment('État de la vente');
            $table->string('aib_amount')->nullable()->comment("Montant de l'aib");
            $table->string('tax_group')->nullable()->comment("Groupe d'imposition");
            $table->text('notes')->nullable()->comment('Notes supplémentaires sur la vente');
            $table->string('phone_client')->nullable();
            $table->string('client_ifu')->nullable();
            $table->string('client_fullname')->nullable();
            $table->string('client_address')->nullable();
            $table->text('commentaire')->nullable();
            $table->string('identify_of_mobile_trasaction')->nullable();
            $table->string('reference_of_cheque')->nullable();
            $table->string('name_banque_of_checque')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('sales');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
