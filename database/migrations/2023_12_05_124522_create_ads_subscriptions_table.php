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
        Schema::create('ads_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('ads_id');
            $table->string('ads_type');
            $table->unsignedBigInteger('package_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_amount');
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('package_id')->references('id')->on('ads_packages');

            // Indexes
            $table->index('client_id');
            $table->index('package_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_subscriptions');
    }
};
