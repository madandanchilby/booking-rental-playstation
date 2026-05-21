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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('midtrans_order_id')->nullable()->after('total_booking_fee');
            $table->string('snap_token')->nullable()->after('midtrans_order_id');
            $table->string('payment_status')->default('pending')->after('snap_token');
            $table->string('payment_type')->nullable()->after('payment_status');
            $table->string('midtrans_transaction_id')->nullable()->after('payment_type');
            $table->timestamp('paid_at')->nullable()->after('midtrans_transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'midtrans_order_id',
                'snap_token',
                'payment_status',
                'payment_type',
                'midtrans_transaction_id',
                'paid_at',
            ]);
        });
    }
};
