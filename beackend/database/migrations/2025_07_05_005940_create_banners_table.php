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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->text('image');                      // Image URL or path
            $table->string('title');                   // Main banner title
            $table->string('subtitle')->nullable();    // Optional subtitle
            $table->string('cta')->nullable();         // Call to action button text (e.g. "Shop Now")
            $table->string('cta_url')->nullable();     // URL the CTA button should link to
            $table->enum('position', ['top', 'middle', 'bottom'])->default('top');  // Banner display position
            $table->enum('type', ['slider', 'popup', 'static'])->default('slider'); // Type of banner
            $table->integer('order')->nullable();
            $table->boolean('status')->default(true);  // Active/inactive toggle
            $table->timestamp('start_date')->nullable(); // Scheduled start date
            $table->timestamp('end_date')->nullable();   // Scheduled end date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
