<?php
require_once "./mvc/config/dbhelper.php";
require_once "./mvc/config/config.php";
require_once "./mvc/libs/jwt.php";
class Customer
{
    public function getCustomerList()
    {
        $sql = "SELECT * FROM customer";
        return executeResult($sql);
    }
    public function checkPassword($username, $password)
    {
        $sql = "SELECT * FROM customer WHERE username = '" . $username . "'";
        $user = executeResult($sql, true);
        if ($user['password'] == $password) {
            // $token = JWT::jsonEncode(JWT::encode($user, SECRET_KEY));
            $data = [
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'address' => $user['address']
            ];
            return array(
                'status' => 'Ok',
                'status_code' => '200',
                'message' => 'Login successfully',
                'data' => json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
            );
        }
        return array(
            'status' => 'Fail',
            'status_code' => '400',
            'message' => 'Password incorrect',
            'token' => ''
        );
    }
    public function createNewCustomer($firstname, $lastname, $email, $address, $phone, $gender, $username, $password)
    {
        $sql = "INSERT INTO `customer`(`firstname`, `lastname`, `email`, `phone`, `address`, `gender`, `username`, `password`) VALUES ('" . $firstname . "','" . $lastname . "','" . $email . "','" . $phone . "','" . $address . "','" . $gender . "','" . $username . "','" . $password . "')";
        execute($sql);
    }
    public function isUserExist($username)
    {
        $sql = "SELECT * FROM customer WHERE username = '" . $username . "'";
        $user = executeResult($sql);
        if (count($user) > 0) {
            return true;
        }
        return false;
    }
    public function convertTokenToString($token)
    {
        $rs = '';
        for ($i = 0; $i < strlen($token) - 1; $i++) {
            if ($i != 0 && $i != strlen($token) - 1) {
                $rs .= $token[$i];
            }
        }
        return $rs;
    }
    public function convertTokenToData($token)
    {
        // $stringToken = self::convertTokenToString($token);
        return json_decode(JWT::jsonEncode(JWT::decode($token, SECRET_KEY)), true);
    }
    public function isTokenValid($username, $token)
    {
        $sql = "SELECT COUNT(*) FROM customer WHERE username = '" . $username . "' AND token = '" . $token . "'";
        $user = executeResult($sql, true);
        if ($user > 0) {
            return true;
        }
        return false;
    }
    public function updateToken($username, $token)
    {
        $sql = "UPDATE `customer` SET `token`='" . $token . "' WHERE username = '" . $username . "'";
        execute($sql);
    }
    public function deleteCustomerById($id)
    {
        $sql = "DELETE FROM `customer` WHERE id = '" . $id . "'";
        execute($sql);
    }
    public function getCustomerById($id)
    {
        $query = "SELECT * FROM `customer` WHERE id = " . $id;
        return executeResult($query, true);
    }
    public function updateCustomerInfo($id, $firstname, $lastname, $email, $address, $phone, $gender, $username, $password)
    {
        $sql = "UPDATE `customer` SET `firstname`='{$firstname}',`lastname`='{$lastname}',`email`='{$email}',`phone`='{$phone}',`address`='{$address}',`gender`='{$gender}',`password`='{$password}',`updateDate`='" . date('YmdHis') . "' WHERE id = '" . $id . "'";
        execute($sql);
    }
}
