<?php
require_once '../lib/ApiClient.php';

class ProjectsController {
    private $apiClient;

    public function __construct() {
        $this->apiClient = new ApiClient();
    }

    public function showProjects() {
        // Fetch projects data from the API
        $projects = $this->apiClient->get('/projects');

        // Render the view with the data
        require '../views/projects/projects.php';
    }
}
