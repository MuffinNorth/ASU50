<?php
require_once "./PHP/controllers/log_controller.php";
if(isset($_GET['username']) and isset($_GET['token'])){
    $u = $_GET['username'];
    $sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();
    if($result['token'] == $_GET['token']){
        $id= $_GET['id'];
        $sql;
        if($_GET['type'] == "add"){
            $sql = "UPDATE `feedbacks` SET `favorites` = b'1' WHERE `feedbacks`.`id` = $id ";
            write_log($_SESSION['logindata']['username'], "Отметил избранным отзыв с id " . $id);
        }elseif($_GET['type'] == "remove"){
            $sql = "UPDATE `feedbacks` SET `favorites` = b'0' WHERE `feedbacks`.`id` = $id ";
            write_log($_SESSION['logindata']['username'], "Убрал из избранного отзыв с id " . $id);
        }
        $result = $mysqli->query($sql);
        echo $sql;
        
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }else{
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }
}else{
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
}