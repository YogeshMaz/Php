<?php
require_once '../lib/ApiClient.php';

class AnalyticsController {
    private $apiClient;

    public function __construct() {
        $this->apiClient = new ApiClient();
    }

    public function showAnalytics() {
        // Fetch analytics data from the API
        $analyticsData = $this->apiClient->get('/analytics');

        // Render the view with the data
        require '../views/analytics/analytics.php';
    }
}
