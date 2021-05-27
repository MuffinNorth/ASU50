<?php
require_once "./PHP/dbconnetion.php";

function write_log($username, $what){
    global $mysqli;
    $id = getID($username);
    $sql = "INSERT INTO `admin_log` (`who`, `when`, `what`) VALUES '$id', '', '',)";
}

function getID($username){
    global $mysqli;
    $sql = "SELECT `id` FROM `admins` WHERE `login`='$username'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();
    return $result['id'];
}