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
        Schema::create('histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('booking_start_date');
            $table->dateTime('booking_end_date');
            $table->smallInteger('booking_hour');
            $table->integer('total_booking_fee');
            $table->string('computer_id');
            $table->string('customer_id');
            $table->foreign('computer_id')->references('id')->on('computers');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
