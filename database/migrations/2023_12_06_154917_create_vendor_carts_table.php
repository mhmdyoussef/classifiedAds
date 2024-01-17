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
        Schema::create('vendor_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('vendor_product_id');
            $table->string('vendor_product_sku')->nullable();
            $table->integer('quantity');
            $table->json('option')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('vendor_product_id')->references('id')->on('vendor_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_carts');
    }
};
