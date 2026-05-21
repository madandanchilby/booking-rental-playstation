<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    private string $serverKey;
    private string $clientKey;
    private bool $isProduction;
    private string $baseUrl;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->clientKey = config('midtrans.client_key');
        $this->isProduction = config('midtrans.is_production');
        $this->baseUrl = $this->isProduction
            ? config('midtrans.production_base_url')
            : config('midtrans.sandbox_base_url');
    }

    /**
     * Create a Snap transaction token for bank transfer payment.
     */
    public function createSnapToken(array $params): ?string
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':'),
            ])->post($this->baseUrl . '/transactions', $params);

            if ($response->successful()) {
                $body = $response->json();
                return $body['token'] ?? null;
            }

            Log::error('Midtrans Snap Token Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Build transaction parameters for Snap API.
     */
    public function buildTransactionParams(
        string $orderId,
        int $grossAmount,
        string $customerName,
        string $customerEmail,
        string $customerPhone,
        array $itemDetails = []
    ): array {
        return [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $customerName,
                'email' => $customerEmail,
                'phone' => $customerPhone,
            ],
            'item_details' => $itemDetails,
            'enabled_payments' => [
                'bca_va',
                'bni_va',
                'bri_va',
                'permata_va',
                'other_va',
            ],
        ];
    }

    /**
     * Verify notification signature from Midtrans.
     */
    public function verifySignature(string $orderId, string $statusCode, string $grossAmount, string $signatureKey): bool
    {
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $this->serverKey);
        return $expectedSignature === $signatureKey;
    }

    /**
     * Get the Midtrans client key for frontend usage.
     */
    public function getClientKey(): string
    {
        return $this->clientKey;
    }

    /**
     * Get the Snap JS URL based on environment.
     */
    public function getSnapJsUrl(): string
    {
        return $this->isProduction
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    }
}
