<?php
require_once "./PHP/dbconnetion.php";
require_once "./PHP/controllers/log_controller.php";
function login($username, $password){
    global $mysqli;
    $sql = "SELECT `password` FROM `admins` WHERE `login`='$username'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();
    if(password_verify($password, $result['password'])){
        $token = generateToken();
        $sql = "UPDATE `admins` SET `token` = '$token' WHERE `admins`.`login` = '$username'";
        $res = $mysqli->query($sql);
        write_log($username, "Вошёл в панель модератора");
        return $token;
    }
    return false;
}

function generateToken(){
    return rand(111111, 999999);
}