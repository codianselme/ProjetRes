<?php

namespace App\Services;

use App\Contracts\SgmefApiContract;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Factory as HttpClient;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;

class SgmefApiService implements SgmefApiContract
{
    protected string $apiBaseUrl;
    protected string $apiKey;
    protected HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->apiBaseUrl = env('SGMEF_API_BASE_URL');
        $this->apiKey = env('SGMEF_API_KEY');

        if (!$this->apiBaseUrl || !$this->apiKey) {
            throw new \Exception('API Base URL or API Key not set in the .env file.');
        }
    }

    public function getStatuses()
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/info/status');
    }

    public function getTaxGroups()
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/info/taxGroups');
    }

    public function getInvoiceTypes()
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/info/invoiceTypes');
    }

    public function getPaymentTypes()
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/info/paymentTypes');
    }

    public function getInvoiceStatuses()
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/info/invoiceStatuses');
    }

    public function getInvoiceTypeList()
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/info/invoiceTypeList');
    }

    public function getPaymentTypeList()
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/info/paymentTypeList');
    }

    public function createInvoice(array $data)
    {
        return $this->callApiEndpoint('POST', $this->apiBaseUrl . '/invoice', $data);
    }

    public function getInvoice(string $uid)
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/invoice/' . $uid);
    }

    public function confirmInvoice(string $uid)
    {
        return $this->callApiEndpoint('PUT', $this->apiBaseUrl . '/invoice/' . $uid . '/confirm');
    }

    public function cancelInvoice(string $uid)
    {
        return $this->callApiEndpoint('PUT', $this->apiBaseUrl . '/invoice/' . $uid . '/cancel');
    }

    public function getSupportedCountries()
    {
        return $this->callApiEndpoint('GET', $this->apiBaseUrl . '/info/supportedCountries');
    }

    public function getInvoiceByUid(string $uid): array
    {
        $response = $this->callApiEndpoint('GET', $this->apiBaseUrl . '/invoice/' . $uid);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    protected function callApiEndpoint(string $method, string $endpoint, ?array $data = [])
    {
        try {
            $jsonData = json_encode($data);

            Log::channel('invoice')->info('Calling API Endpoint', [
                'method' => $method,
                'endpoint' => $endpoint,
                'data' => $jsonData
            ]);

            $response = Http::withToken($this->apiKey)->{$method}($endpoint, $data);

            if ($response->successful()) {
                Log::channel('invoice')->info('API call successful', [
                    'endpoint' => $endpoint,
                    'response' => $response->json()
                ]);
                return $response->json();
            } else {
                Log::channel('invoice')->error('API call failed', [
                    'endpoint' => $endpoint,
                    'response' => $response->json(),
                    'status' => $response->status()
                ]);
                throw new \Exception($response->json('message') ?? $response, $response->status());
            }
        } catch (\Exception $e) {
            Log::channel('invoice')->error('Error calling API endpoint', [
                'message' => $e->getMessage(),
                'method' => $method,
                'endpoint' => $endpoint,
                'data' => $jsonData
            ]);
            throw $e;
        }
    }
}
