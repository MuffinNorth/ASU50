<?php
require_once "./PHP/dbconnetion.php";
require_once "./PHP/controllers/log_controller.php";
$u = $_SESSION['logindata']['username'];
$sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
$result = $mysqli->query($sql);
$result = $result->fetch_assoc();
if($result['token'] == $_SESSION['logindata']['token']){
    $sql = "DELETE FROM `logs`";
    $mysqli->query($sql);
    write_log($_SESSION['logindata']['username'], "Очистил логи");
}