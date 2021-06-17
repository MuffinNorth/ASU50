<?php
require_once "./PHP/dbconnetion.php";
require_once "./PHP/controllers/log_controller.php";
$u = $_SESSION['logindata']['username'];
$sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
$result = $mysqli->query($sql);
$result = $result->fetch_assoc();
if($result['token'] == $_SESSION['logindata']['token']){
    if(isset($_POST['delete'])){
        $id = $_POST['ID'];
        $sql = "DELETE FROM `admins` WHERE `admins`.`id` = $id";
        $res = $mysqli->query($sql);
        write_log($_SESSION['logindata']['username'], "Обновил модератора с id " . $id);
    }elseif(isset($_POST['ID'])){
        $id = $_POST['ID'];
        $login = $_POST['flogin'];
        $email = $_POST['email'];
        if(!empty($_POST['password'])){
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $sql = "UPDATE `admins` SET `login` = '$login', `email` = '$email', `password` = '$password' WHERE `admins`.`id` = 1 ";
            
        }else{
            $sql = "UPDATE `admins` SET `login` = '$login', `email` = '$email' WHERE `admins`.`id` = 1 ";
        }
        $res = $mysqli->query($sql);
        echo $res;
        write_log($_SESSION['logindata']['username'], "Обновил модератора с логином " . $login);
        header('Location: /admin/settings?goodUpdate');
    }else{
        $login = $_POST['flogin'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO `admins` (`login`, `email`, `password`) VALUES ( '$login', '$email', '$password')";
        $user = $mysqli->query($sql);
        if($user){
            header('Location: /admin/settings?goodCreate');
            write_log($_SESSION['logindata']['username'], "Создал модератора с логином " . $login);
        }else{
            header('Location: /admin/settings?badCreate');
        }
    }
}


