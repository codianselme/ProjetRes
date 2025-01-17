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
        Schema::create('command_items', function (Blueprint $table) {
            $table->id();
            $table->string('dish_name');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->text('notes')->nullable();
            $table->foreignId('command_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('command_items');
    }
};
