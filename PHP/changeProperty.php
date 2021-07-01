<?php
require_once "./PHP/controllers/log_controller.php";
if(isset($_POST['username']) and isset($_POST['token'])){
    $u = $_POST['username'];
    $sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();
    if($result['token'] == $_POST['token']){
        $property= $_POST['property'];
        $value = $_POST['value'];
        $sql = "UPDATE `settings` SET `value`='$value' WHERE `property`='$property'";
        $result = $mysqli->query($sql);
        write_log($_SESSION['logindata']['username'], "Обновил настройки сервера ($property)" );
        echo json_encode($sql, JSON_UNESCAPED_UNICODE);
    }else{
        echo json_encode('1', JSON_UNESCAPED_UNICODE);
    }
}else{
    echo json_encode('2', JSON_UNESCAPED_UNICODE);
}