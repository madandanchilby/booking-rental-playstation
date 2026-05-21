<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\MidtransService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    /**
     * Handle Midtrans payment notification (webhook).
     */
    public function handle(Request $request): JsonResponse
    {
        $payload = $request->all();

        Log::info('Midtrans Notification Received', $payload);

        $orderId = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $paymentType = $payload['payment_type'] ?? null;
        $transactionId = $payload['transaction_id'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
            return response()->json(['message' => 'Invalid notification payload.'], 400);
        }

        // Verify signature
        $midtransService = new MidtransService();
        $isValid = $midtransService->verifySignature($orderId, $statusCode, $grossAmount, $signatureKey);

        if (!$isValid) {
            Log::warning('Midtrans notification signature invalid', ['order_id' => $orderId]);
            return response()->json(['message' => 'Invalid signature.'], 403);
        }

        // Find bookings by order ID
        $bookings = Booking::where('midtrans_order_id', $orderId)->get();

        if ($bookings->isEmpty()) {
            Log::warning('Midtrans notification for unknown order', ['order_id' => $orderId]);
            return response()->json(['message' => 'Order not found.'], 404);
        }

        // Determine payment status based on transaction status
        $paymentStatus = $this->resolvePaymentStatus($transactionStatus, $fraudStatus);

        // Update all bookings with same order_id
        $updateData = [
            'payment_status' => $paymentStatus,
            'payment_type' => $paymentType,
            'midtrans_transaction_id' => $transactionId,
        ];

        if ($paymentStatus === 'paid') {
            $updateData['paid_at'] = now();
            $updateData['status'] = 'confirmed';
        }

        Booking::where('midtrans_order_id', $orderId)->update($updateData);

        Log::info('Midtrans notification processed', [
            'order_id' => $orderId,
            'status' => $paymentStatus,
        ]);

        return response()->json(['message' => 'Notification processed successfully.']);
    }

    /**
     * Resolve payment status from Midtrans transaction status.
     */
    private function resolvePaymentStatus(string $transactionStatus, ?string $fraudStatus): string
    {
        if ($transactionStatus === 'capture') {
            return ($fraudStatus === 'accept') ? 'paid' : 'pending';
        }

        return match ($transactionStatus) {
            'settlement' => 'paid',
            'pending' => 'pending',
            'deny', 'cancel' => 'failed',
            'expire' => 'expired',
            default => 'pending',
        };
    }
}
