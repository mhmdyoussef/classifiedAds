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
        Schema::create('vendor_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_order_id');
            $table->unsignedBigInteger('vendor_product_id');
            $table->string('quantity');
            $table->string('price');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('vendor_order_id')->references('id')->on('vendor_orders');
            $table->foreign('vendor_product_id')->references('id')->on('vendor_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_order_items');
    }
};
