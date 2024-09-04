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
        Schema::create('rooms_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('room_id')->references('id')->on('rooms');
            $table->integer('number');
            $table->char('status', 'A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_items');
    }
};
