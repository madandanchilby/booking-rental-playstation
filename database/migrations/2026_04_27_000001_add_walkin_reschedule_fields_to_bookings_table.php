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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_type')->default('online')->after('id'); // online, walk_in
            $table->string('status')->default('pending')->after('booking_type'); // pending, confirmed, completed, cancelled, rescheduled
            $table->string('rescheduled_from_id')->nullable()->after('paid_at'); // links to original booking
            $table->string('customer_name_walkin')->nullable()->after('rescheduled_from_id'); // for walk-in without account
            $table->string('customer_phone_walkin')->nullable()->after('customer_name_walkin');
        });

        // Make customer_id nullable for walk-in bookings (raw SQL since doctrine/dbal is not installed)
        DB::statement('ALTER TABLE bookings MODIFY customer_id VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'booking_type',
                'status',
                'rescheduled_from_id',
                'customer_name_walkin',
                'customer_phone_walkin',
            ]);
        });

        DB::statement('ALTER TABLE bookings MODIFY customer_id VARCHAR(255) NOT NULL');
    }
};
