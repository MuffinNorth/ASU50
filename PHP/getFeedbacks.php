<?php
    header("Content-Type: application/json");
    $sql = "SELECT `id`, `name`, `group`, `review`, `city`, `avatar_path` FROM `feedbacks` WHERE feedbacks.moderation_type=1 and (not feedbacks.review = '')";
    $result = $mysqli->query($sql);
    $out = array();
    $out["size"] = $result->num_rows;
    for($i = 1; $i <= $result->num_rows; $i++){
        $out[$i] = $result->fetch_assoc();
    }
    echo json_encode($out, JSON_UNESCAPED_UNICODE);