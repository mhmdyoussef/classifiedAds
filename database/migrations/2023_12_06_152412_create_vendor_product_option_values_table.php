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
        Schema::create('vendor_product_option_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_product_option_id');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('label')->nullable();
            $table->timestamps();

            // Index
            $table->index('vendor_product_option_id');

            // Foreign Keys
            $table->foreign('vendor_product_option_id')->references('id')->on('vendor_product_options')->onDelete('no action')->onUpdate('no action');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_product_option_values');
    }
};
