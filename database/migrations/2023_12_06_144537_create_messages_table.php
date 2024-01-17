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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->text('message');
            $table->boolean('is_seen')->default(false);
            $table->dateTime('sent_at')->default(now());
            $table->dateTime('seen_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('sender_id');
            $table->index('receiver_id');

            // Foreign Keys
            $table->foreign('sender_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
