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

            // Basic Details
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('summary')->nullable();

            // Pricing & Discount
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->enum('discount_type', ['fixed', 'percentage'])->nullable();
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->decimal('final_price', 10, 2)->nullable();
            $table->integer('quantity')->default(0);

            // Category Relationship
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('sub_category_id')->nullable()->constrained('categories')->onDelete('set null');

            // Status Flags
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('new_product')->default(false);
            $table->boolean('best_seller')->default(false);

            // Thumbnail
            $table->string('thumbnail')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();

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
