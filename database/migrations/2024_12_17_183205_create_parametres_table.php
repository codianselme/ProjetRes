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
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('Le type de structure (par exemple, Bar restaurant)');
            $table->string('name')->comment('Nom de la structure (par exemple, nom du restaurant)');
            $table->string('address')->comment('Adresse de la structure');
            $table->string('contact_phone_1')->comment('Numéro de contact (par exemple, téléphone)');
            $table->string('contact_phone_2')->comment('Numéro de contact (par exemple, téléphone)');
            $table->string('contact_phone_3')->comment('Numéro de contact (par exemple, téléphone)');
            $table->string('email')->nullable()->comment('Email de contact');
            $table->string('website')->nullable()->comment('Site web de la structure');
            $table->text('description')->nullable()->comment('Description de la structure');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametres');
    }
};
