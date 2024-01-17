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
        Schema::create('vendor_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_store_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('client_address_id');
            $table->string('invoice_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->float('sub_total')->nullable();
            $table->float('tax_amount')->nullable();
            $table->float('shipping_amount')->nullable();
            $table->float('total_amount')->nullable();
            $table->string('comment')->nullable();
            $table->string('commission')->nullable();
            $table->boolean('client_paid_status')->default(false);
            $table->dateTime('paid_date')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('transaction_details')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('shipping_method')->nullable();
            $table->timestamps();

            // Index
            $table->index('vendor_store_id');
            $table->index('client_id');
            $table->index('client_address_id');

            // Foreign Keys
            $table->foreign('vendor_store_id')->references('id')->on('vendor_stores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('client_address_id')->references('id')->on('client_addresses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_orders');
    }
};
