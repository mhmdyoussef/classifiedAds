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
        Schema::create('ads_commercials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('label')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('subscriptions_id')->nullable();
            $table->json('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('href')->nullable();
            $table->date('start_date')->default(now());
            $table->date('end_date')->nullable();
            $table->float('price')->nullable();
            $table->integer('view')->default(0);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_negotiable')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_premium_extra')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Foreign Key
            $table->foreign('package_id')->references('id')->on('ads_packages');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('category_id')->references('id')->on('ads_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_commercials');
    }
};
