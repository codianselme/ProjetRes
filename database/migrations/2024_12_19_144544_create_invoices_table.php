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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->json('invoiceRequestDataDto')->nullable();
            $table->json('invoiceResponseDataDto')->nullable();
            $table->string('statusInvoice')->default('create');
            $table->string('typeInvoice')->nullable(); // FV (Facture de vente), FA (Facture d'avoir),
            $table->json('securityElementsDto')->nullable();
            $table->unsignedInteger('vente_id')->nullable(); // For vente_physique
            $table->string('invoice_number')->unique();
            $table->text('commentaire')->nullable();
            $table->string('identify_of_mobile_trasaction')->nullable();
            $table->string('reference_of_cheque')->nullable();
            $table->string('name_banque_of_checque')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
