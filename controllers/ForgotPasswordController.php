<?php
require_once '../lib/ApiClient.php';

class ForgotPasswordController {
    private $apiClient;

    public function __construct() {
        $this->apiClient = new ApiClient();
    }

    public function showForgotPasswordForm() {
        require '../views/login/forgot_password.php';
    }

    public function resetPassword() {
        $email = $_POST['email'];
        $response = $this->apiClient->post('/auth/forgot-password', ['email' => $email]);

        if ($response['status'] === 'success') {
            $message = 'Password reset link sent.';
            require '../views/login/forgot_password.php';
        } else {
            $error = 'Email not found';
            require '../views/login/forgot_password.php';
        }
    }
}
