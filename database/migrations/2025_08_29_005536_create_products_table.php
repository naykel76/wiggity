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
        // Most fields are set as nullable to simplify testing different
        // scenarios, although typically they would not be nullable.
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Product Identity
            $table->string('name')->nullable();      // Basic product title - what you'd call it if someone asked "what are you selling?"
            $table->string('headline')->nullable();  // Catchy marketing phrase (e.g., "The Ultimate Gadget")
            $table->text('description')->nullable(); // Full description
            $table->string('main_image')->nullable();

            // Product Codes and Identifiers
            $table->string('slug')->unique()->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('department')->nullable();

            // Pricing & Inventory
            $table->unsignedInteger('price')->nullable();
            $table->integer('stock')->default(0);

            // Special Pricing
            $table->datetime('special_start_date')->nullable();
            $table->datetime('special_end_date')->nullable();
            $table->unsignedInteger('special_price')->nullable();

            // Flexibility & Status
            $table->json('extra_data')->nullable();
            $table->boolean('active')->default(true);

            // Indexes for Performance
            // $table->index('active');
            // $table->index(['special_start_date', 'special_end_date']);

            $table->timestamps();
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
