<?php
require_once '../lib/Session.php';
require_once '../lib/Auth.php';

class LoginController {
    private $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function showLoginForm() {
        require '../views/login/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->auth->login($username, $password)) {
                header('Location: /dashboard');
                exit();
            } else {
                $error = 'Invalid credentials';
                require '../views/login/login.php';
            }
        } else {
            // Handle the case where the request is not POST
            header('Location: /login');
            exit();
        }
    }

    public function logout() {
        $this->auth->logout();
        header('Location: /login');
        exit();
    }

    public function getUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $resUser = $this->fetchDataOfUsers('Customer_Portal_Database_Report', 'machinemaze-project-management');
            $resUserData = json_decode($resUser, true);

            if ($resUserData && $resUserData['code'] === 3000) {
                $user = $this->simulateLogin($email, $password, $resUserData['data']);
                
                if ($user) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $user['Organisation_Name']['Customer_Email'] ?? 'No Org';
                    // Populate other session variables
                    $this->populateUserSession($user);

                    header('Location: datapages/customer_dash.php');
                    exit();
                } else {
                    header('Location: /index.php?error=invalid');
                    exit();
                }
            } else {
                echo 'Failed to fetch user data or invalid response code.';
            }
        }
    }

    private function populateUserSession($user) {
        // Example of populating session variables
        $_SESSION['address'] = $user['Customer_Contact_Address']['zc_display_value'] ?? 'No Address';
        $_SESSION['orgname'] = $user['Select_Org']['Name'] ?? 'No Org';
        $_SESSION['Contact_No'] = $user['Customer_Mobile_Number_Land_Line'] ?? 'No Contact';
        $_SESSION['name'] = $user['Customer_Name']['zc_display_value'] ?? 'User';
        $_SESSION['logo'] = $user['Customer_Logo'] ?? null;
        $_SESSION['id'] = $user['ID'] ?? null;
        $_SESSION['Give_Access_To'] = $user['Give_Access_To1'] ?? null;
    }

    private function fetchDataOfUsers($reportname, $appname) {
        $access_token = "1000.c98b11ee09fd207dedf46e4a04393aa2.1cead7ceaeeb7c885997185eea2c3fd2";
        $url = "https://creator.zoho.in/api/v2.1/arun.ramu_machinemaze/" . urlencode($appname) . "/report/" . $reportname;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Zoho-oauthtoken $access_token",
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private function simulateLogin($email, $inputPassword, $users) {
        foreach ($users as $user) {
            if ($user['Email'] === $email && md5($inputPassword) === $user['password']) {
                return $user;
            }
        }
        return false;
    }
}
