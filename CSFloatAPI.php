<?php

class CSFloatAPI {
    private $apiKey;
    private $apiBaseUrl = "https://csfloat.com/api/v1";

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    private function sendRequest($method, $endpoint, $data = []) {
        $url = $this->apiBaseUrl . $endpoint;
        $headers = [
            "Authorization: {$this->apiKey}",
            "Content-Type: application/json"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ['statusCode' => $statusCode, 'body' => json_decode($response, true)];
    }

    public function getAllListings($queryParams = []) {
        $endpoint = "/listings";
        if (!empty($queryParams)) {
            $query = http_build_query($queryParams);
            $endpoint .= "?" . $query;
        }
        return $this->sendRequest('GET', $endpoint);
    }

    public function getSpecificListing($listingId) {
        $endpoint = "/listings/" . $listingId;
        return $this->sendRequest('GET', $endpoint);
    }

    public function createListing($listingDetails) {
        $endpoint = "/listings";
        return $this->sendRequest('POST', $endpoint, $listingDetails);
    }
}

// Usage:
$apiKey = 'YOUR_API_KEY';
$csFloatAPI = new CSFloatAPI($apiKey);

// Example calls
// Get all listings
$allListings = $csFloatAPI->getAllListings(['page' => 1, 'limit' => 10]);
// Get a specific listing
$specificListing = $csFloatAPI->getSpecificListing('324288155723370196');
// Create a new listing
$newListing = $csFloatAPI->createListing([
    'asset_id' => '21078095468',
    'type' => 'buy_now',
    'price' => 8900,
    'description' => 'Just for show',
    'private' => false
]);

?>
