<?php
require_once "./mvc/config/dbhelper.php";
require_once "./mvc/config/config.php";

class AdminAccount
{
    public function getAdminAccountList()
    {
        $stmt = $this->conn->prepare("SELECT * FROM admin_account");
        $stmt->execute();
        return $stmt;
    }
    public function checkPassword($username, $password)
    {
        $sql = "SELECT * FROM admin_account WHERE username = '" . $username . "'";
        $user = executeResult($sql, true);
        if ($user['password'] == $password) {
            $data = [
                'fullname' => $user['fullname'],
                'createDate' => $user['createDate'],
                'updateDate' => $user['updateDate']
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
    public function createNewAdminAccount($fullname, $username, $password)
    {
        $sql = "INSERT INTO `admin_account`(`fullname`, `username`, `password`) VALUES ('" . $fullname . "','" .  $username . "','" . $password . "')";
        execute($sql);
    }
    public function isAdminAccountExist($username)
    {
        $sql = "SELECT * FROM admin_account WHERE username = '" . $username . "'";
        $account = executeResult($sql);
        if (count($account) > 0) {
            return true;
        }
        return false;
    }
}
