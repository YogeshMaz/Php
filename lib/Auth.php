<?php
require_once '../lib/ApiClient.php';

class Auth {
    private $apiClient;

    public function __construct() {
        $this->apiClient = new ApiClient();
    }

    public function login($username, $password) {
        $response = $this->apiClient->post('/auth/login', [
            'username' => $username,
            'password' => $password
        ]);

        if ($response['status'] === 'success') {
            Session::set('user_token', $response['token']);
            return true;
        }

        return false;
    }

    public function logout() {
        Session::destroy();
    }
}


