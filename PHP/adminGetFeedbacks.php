<?php
    header("Content-Type: application/json");
    if(isset($_GET['username']) and isset($_GET['token'])){
        $u = $_GET['username'];
        $sql = "SELECT `token` FROM `admins` WHERE admins.login = '$u'";
        $result = $mysqli->query($sql);
        $result = $result->fetch_assoc();
        if($result['token'] == $_GET['token']){
            $type = $_GET['type'];
            $sql = "SELECT * FROM `feedbacks` WHERE moderation_type = $type  ORDER BY `feedbacks`.`id` DESC";
            $result = $mysqli->query($sql);
            $out = array();
            $out["size"] = $result->num_rows;
            for($i = 1; $i <= $result->num_rows; $i++){
                $out[$i] = $result->fetch_assoc();
            }
            echo json_encode($out, JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(true, JSON_UNESCAPED_UNICODE);
        }
    }else{
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }