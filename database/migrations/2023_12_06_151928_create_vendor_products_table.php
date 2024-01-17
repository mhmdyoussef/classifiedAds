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
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->string('sku');
            $table->string('model')->nullable();
            $table->float('price');
            $table->integer('quantity');
            $table->json('image')->nullable();
            $table->tinyInteger('tax_id')->nullable();
            $table->decimal('weight')->nullable();
            $table->integer('minimum')->nullable();
            $table->boolean('shipping')->default(true);
            $table->tinyInteger('sort_order')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Index
            $table->index('store_id');

            // Foreign Key
            $table->foreign('store_id')->references('id')->on('vendor_stores')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_products');
    }
};
