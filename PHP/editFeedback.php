<?php
require_once "./PHP/controllers/log_controller.php";
if(isset($_GET['username']) and isset($_GET['token'])){
    $u = $_GET['username'];
    $sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();
    if($result['token'] == $_GET['token']){
        $id= $_GET['id'];
        $name = $_GET['name'];
        $group = $_GET['group'];
        $review = $_GET['review'];
        $city = $_GET['city'];
        $workplace = $_GET['workplace'];
        $email = $_GET['email'];
        $sql = "UPDATE `feedbacks` SET `name` = '$name', `group` = '$group', `review` = '$review', `city` = '$city', `workplace` = '$workplace', `email` = '$email' WHERE `feedbacks`.`id` = $id ";
        $result = $mysqli->query($sql);
        write_log($_SESSION['logindata']['username'], "Отредактировал отзыв с id " . $id);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }else{
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }
}else{
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
}