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
        Schema::create('ads_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('store_type')->nullable();
            $table->json('social_links')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->json('working_times')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('description')->nullable();
            $table->string('commercial_documents')->nullable();
            $table->unsignedBigInteger('subscriptions_id');
            $table->dateTime('start_date')->default(now());
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_featured')->nullable();
            $table->boolean('is_premium_extra')->nullable();
            $table->boolean('status')->dafault(true);
            $table->timestamps();

            // Indexes
            $table->index('client_id');
            $table->index('category_id');

            // Foreign Keys
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('ads_categories')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_stores');
    }
};
