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
        Schema::create('vendor_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->json('title');
            $table->json('description')->nullable();
            $table->json('label')->nullable();
            $table->json('image')->nullable();
            $table->integer('sort_order')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Index
            $table->index('parent_id');

            // Foreign Key
            $table->foreign('parent_id')->references('id')->on('vendor_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_categories');
    }
};
