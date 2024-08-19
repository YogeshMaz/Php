<?php
class ApiClient {
    private $baseUrl;
    private $apiKey;

    public function __construct() {
        $config = require '../config/api.php';
        $this->baseUrl = $config['base_url'];
        $this->apiKey = $config['api_key'];
    }

    private function request($endpoint, $method = 'GET', $data = []) {
        $url = $this->baseUrl . $endpoint;
        $options = [
            'http' => [
                'header'  => "Authorization: Bearer $this->apiKey\r\n" .
                             "Content-Type: application/json\r\n",
                'method'  => $method,
                'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }

    public function post($endpoint, $data) {
        return $this->request($endpoint, 'POST', $data);
    }

    public function get($endpoint) {
        return $this->request($endpoint, 'GET');
    }
}
