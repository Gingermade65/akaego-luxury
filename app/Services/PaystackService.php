<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class PaystackService
{
    protected string $baseUrl;
    protected string $secretKey;

    public function __construct()
    {
        $this->baseUrl = config('services.paystack.payment_url', 'https://api.paystack.co');
        $this->secretKey = config('services.paystack.secret_key');
    }

    /**
     * Initialize a Paystack transaction session
     */
    public function initializeTransaction(array $data): array
    {
        $response = Http::withToken($this->secretKey)
            ->acceptJson()
            ->post("{$this->baseUrl}/transaction/initialize", $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new Exception($response->json()['message'] ?? 'Failed to initialize Paystack payment.');
    }

    /**
     * Verify a transaction using its reference
     */
    public function verifyTransaction(string $reference): array
    {
        $response = Http::withToken($this->secretKey)
            ->acceptJson()
            ->get("{$this->baseUrl}/transaction/verify/{$reference}");

        if ($response->successful()) {
            return $response->json();
        }

        throw new Exception('Payment verification failed.');
    }
}