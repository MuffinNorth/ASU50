<?php
require_once "./PHP/controllers/log_controller.php";
if(isset($_GET['username']) and isset($_GET['token'])){
    $u = $_GET['username'];
    $sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();
    if($result['token'] == $_GET['token']){
        $id= $_GET['id'];
        $sql = "UPDATE `feedbacks` SET `moderation_type` = '2' WHERE `feedbacks`.`id` = $id";
        $result = $mysqli->query($sql);
        echo $sql;
        write_log($_SESSION['logindata']['username'], "Отклонил отзыв с id " . $id);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }else{
        echo json_encode(true, JSON_UNESCAPED_UNICODE);
    }
}else{
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
}