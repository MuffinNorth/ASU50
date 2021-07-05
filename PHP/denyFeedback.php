<?php
require_once "./PHP/controllers/log_controller.php";
require_once "./PHP/controllers/mail_contoller.php";
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
        $sql = "SELECT email FROM `feedbacks` WHERE `id`=$id";
        $result = $mysqli->query($sql);
        $email = $result->fetch_assoc()['email'];
        $sql = "SELECT value FROM `settings` WHERE property='feedbackMessageTitle'";
        $title = $mysqli->query($sql)->fetch_assoc()['value'];
        $sql = "SELECT value FROM `settings` WHERE property='denyMessage'";
        $message = $mysqli->query($sql)->fetch_assoc()['value'];
        $sql = "SELECT * FROM `feedbacks` WHERE `id`=$id";
        $ctx = $mysqli->query($sql)->fetch_assoc();
        sendMail($email, "$title", "$message", $ctx);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }else{
        echo json_encode(true, JSON_UNESCAPED_UNICODE);
    }
}else{
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
}