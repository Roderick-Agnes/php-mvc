<?php
require_once('./mvc/utils/utility.php');

class Auth extends Controller
{
    function Login()
    {
        $this->view("login", []);
    }
    function handleLoginWithToken()
    {
        //require models
        require_once "./mvc/models/Customer.php";

        $token = $_POST['token'];
        $customer = new Customer();

        $info = $customer->convertTokenToData($token);
        // $currentToken = $customer->convertTokenToString($token);
        $username = $info['username'];
        $password = $info['password'];

        if ($customer->isTokenValid($username, $token)) {
            $customer->updateToken($username, $token);
            echo json_encode(array(
                'status' => 'Ok',
                'status_code' => '200',
                'message' => 'Login with token successfully',
                'token' => $token
            ));
        } else {
            echo json_encode(array(
                'status' => 'Failed',
                'status_code' => '400',
                'message' => 'Login with token failed',
                'token' => ''
            ));
        }
    }
    function handleLogout()
    {
        $_SESSION['greenfood_user'] = null;
    }
    function handleLogin()
    {
        //require models
        require_once "./mvc/models/Customer.php";
        //Call Models
        $customer = new Customer();

        $username = $_POST['username'];
        $password = $_POST['password'];


        $isUserExist = $customer->isUserExist($username);
        if ($isUserExist) {
            $result = $customer->checkPassword($username, $password);
            if ($result['status_code'] == '200') {
                $_SESSION['greenfood_user'] = $result['data'];
                // $customer->updateToken($username, $result['token']);
                echo json_encode(array(
                    'status' => 'Ok',
                    'status_code' => '200',
                    'message' => 'Login successful',
                    'data' => $result['data']
                ));
            } else {
                echo json_encode(array(
                    'status' => 'Fail',
                    'status_code' => '400',
                    'message' => 'Password incorrect',
                    'data' => ''
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 'Fail',
                'status_code' => '400',
                'message' => 'User not found',
                'data' => ''
            ));
        }
    }
    function createAccount()
    {
        //require models
        require_once "./mvc/models/Customer.php";
        //Call Models
        $customer = new Customer();
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];

        $isUserExist = $customer->isUserExist($username);
        if ($isUserExist) {
            echo json_encode(array(
                'status' => 'Ok',
                'status_code' => '409',
                'message' => 'Username already exists',
                'data' => ''
            ));
        } else {
            $customer->createNewCustomer($firstname, $lastname, $email, $address, $phone, $gender, $username, $password);
            echo json_encode(array(
                'status' => 'Ok',
                'status_code' => '200',
                'message' => 'Signup successful',
                'data' => $data
            ));
        }
    }
}
