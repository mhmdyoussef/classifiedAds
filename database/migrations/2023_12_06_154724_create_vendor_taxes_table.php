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
        Schema::create('vendor_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('percentage');
            $table->unsignedBigInteger('country_id');
            $table->timestamps();

            // Foreign Key
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_taxes');
    }
};
