<?php
    require_once "./PHP/controllers/log_controller.php";
    require_once "./PHP/controllers/mail_contoller.php";
    header("Content-Type: application/json");
    if(isset($_POST['username']) && isset($_POST['token'])){
        $u = $_POST['username'];
        $sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
        $result = $mysqli->query($sql);
        $result = $result->fetch_assoc();
        if($result['token'] == $_POST['token']){
            $type = $_POST['type'];
            $sql = "SELECT * FROM `feedbacks` WHERE moderation_type=1";
            $result = $mysqli->query($sql);
            $out = array();
            $out["size"] = $result->num_rows;
            for($i = 1; $i <= $result->num_rows; $i++){
                $ctx = $result->fetch_assoc();
                sendMail($ctx['email'], $_POST['title'], $_POST['message'], $ctx);     
            }
            echo json_encode($out["size"], JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(true, JSON_UNESCAPED_UNICODE);
        }
    }else{
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }