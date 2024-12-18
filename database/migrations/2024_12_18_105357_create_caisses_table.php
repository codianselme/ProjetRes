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
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();

            $table->unsignedInteger('solde_especes_initial')->nullable();
            $table->unsignedInteger('solde_momo_initial')->nullable();

            $table->unsignedInteger('apport_espece')->nullable();
            $table->unsignedInteger('apport_momo')->nullable();

            $table->unsignedInteger('vente_espece')->nullable();
            $table->unsignedInteger('vente_momo')->nullable();

            $table->unsignedInteger('decaissement_espece')->nullable();
            $table->unsignedInteger('decaissement_momo')->nullable();

            $table->unsignedInteger('solde_especes_final')->nullable();
            $table->unsignedInteger('solde_momo_final')->nullable();

            $table->string('operateur');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisses');
    }
};
