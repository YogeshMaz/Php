<?php
require_once '../lib/ApiClient.php';

class SummaryController {
    private $apiClient;

    public function __construct() {
        $this->apiClient = new ApiClient();
    }

    public function showSummary() {
        // Fetch summary data from the API
        $summaryData = $this->apiClient->get('/summary');

        // Render the view with the data
        require '../views/summary/summary.php';
    }
}
