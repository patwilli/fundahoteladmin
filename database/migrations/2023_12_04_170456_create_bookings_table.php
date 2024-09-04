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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('room_id')->references('id')->on('rooms');
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->date('checkin');
            $table->date('checkout');
            $table->integer('price');
            $table->string('payment_mode');
            $table->tinyInteger('booking_status')->default(0);
            $table->string('bstatus')->default("Pending");
            $table->foreignUuid('room_item_id')->references('id')->on('rooms_items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
