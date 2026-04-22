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
        Schema::create('widgets', function (Blueprint $table) {
            // everything is nullable to allow for maximum flexibility while testing
            // various input types and validation rules
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('widgets')->nullOnDelete();
            $table->string('code')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('headline')->nullable();
            $table->mediumText('overview')->nullable();
            $table->mediumText('highlights')->nullable();
            $table->longText('content')->nullable();
            $table->string('image_name')->nullable();
            $table->string('file_name')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->string('status')->nullable();
            $table->smallInteger('position')->nullable()->default(0);
            $table->unsignedBigInteger('price')->nullable();
            $table->json('extra_data')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('released_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
