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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            // Dealer / Owner of this property
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            // house, flat, plot, shop, office, etc.
            $table->string('property_type');

            // sale or rent
            $table->string('purpose');

            $table->decimal('price', 15, 2);

            $table->decimal('area', 10, 2)->nullable();

            $table->unsignedTinyInteger('bedrooms')->nullable();

            $table->unsignedTinyInteger('bathrooms')->nullable();

            $table->string('address');

            $table->text('description')->nullable();

            // available, hold, sold, rented
            $table->string('status')->default('available');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};