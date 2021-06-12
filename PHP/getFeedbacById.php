<?php
    header("Content-Type: application/json");
    if(isset($_GET['username']) and isset($_GET['token'])){
        $u = $_GET['username'];
        $sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
        $result = $mysqli->query($sql);
        $result = $result->fetch_assoc();
        if($result['token'] == $_GET['token']){
            $id= $_GET['id'];
            $sql = "SELECT * FROM `feedbacks` WHERE `id`=$id";
            $result = $mysqli->query($sql);
            $out = $result->fetch_assoc();
            echo json_encode($out, JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(true, JSON_UNESCAPED_UNICODE);
        }
    }else{
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }