<?php
require_once '../lib/ApiClient.php';

class UserModel {
    private $apiClient;

    public function __construct() {
        $this->apiClient = new ApiClient();
    }

    public function sendPasswordResetLink($email) {
        $response = $this->apiClient->post('/auth/forgot-password', ['email' => $email]);
        return $response['status'] === 'success';
    }
}
