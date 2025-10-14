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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Basic Info
            $table->string('name')->nullable();      // what you'd call it if someone asked "what are you selling?"
            $table->string('code')->unique()->nullable();
            $table->text('description')->nullable();

            // Product Codes and Identifiers
            $table->string('department')->nullable();

            // Pricing & Inventory
            $table->unsignedInteger('price')->nullable();
            $table->integer('stock')->default(0);

            // Flexibility & Status
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
