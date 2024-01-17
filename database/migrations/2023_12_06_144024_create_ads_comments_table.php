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
        Schema::create('ads_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('ads_id');
            $table->string('ad_type');
            $table->string('comment');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            // Foreign Keys
//            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
//            $table->foreign('ads_id')->references('id')->on('ads')->onDelete('cascade');

            // Indexes
//            $table->index('client_id');
//            $table->index('ads_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_comments');
    }
};
