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
        Schema::create('ads_store_products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->float('price');
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->json('image')->nullable();
            $table->integer('views')->default(0);
            $table->integer('sort_order')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Index
            $table->index('store_id');

            // Foreign Key
            $table->foreign('store_id')->references('id')->on('ads_stores')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_store_products');
    }
};
