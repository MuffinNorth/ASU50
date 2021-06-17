<?php
require_once "./PHP/controllers/log_controller.php";
if(isset($_POST['username']) and isset($_POST['token'])){
    $u = $_POST['username'];
    $sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();
    if($result['token'] == $_POST['token']){
        $id= $_POST['id'];
        $name = $_POST['name'];
        $group = $_POST['group'];
        $review = $_POST['review'];
        $city = $_POST['city'];
        $workplace = $_POST['workplace'];
        $email = $_POST['email'];
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