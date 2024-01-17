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
        Schema::create('vendor_product_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_product_id');
            $table->string('sku')->nullable();
            $table->json('image')->nullable();
            $table->string('quantity');
            $table->float('price')->nullable();
            $table->decimal('weight')->nullable();
            $table->timestamps();

            // Index
            $table->index('vendor_product_id');

            // Foreign Key
            $table->foreign('vendor_product_id')->references('id')->on('vendor_products')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_product_options');
    }
};
