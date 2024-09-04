<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('booking_id')->references('id')->on('bookings');
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->integer('inv_amount');
            $table->timestamp('inv_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('inv_status', 10);
            $table->foreignUuid('admin_id')->references('id')->on('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
