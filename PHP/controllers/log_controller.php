<?php
require_once "./PHP/dbconnetion.php";

function write_log($username, $what){
    global $mysqli;
    $id = getID($username);
    $date = "2021-05-18 04:15:11";
    $sql = "INSERT INTO `admin_log` (`who`, `when`, `what`) VALUES ('$id', NOW(), '$what')";
    $mysqli->query($sql);
}

function getID($username){
    global $mysqli;
    $sql = "SELECT `id` FROM `admins` WHERE `login`='$username'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();
    return $result['id'];
}