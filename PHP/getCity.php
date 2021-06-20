<?php
include_once("./PHP/dbconnetion.php");
$sql = "SELECT city, count(*) as count FROM `feedbacks` WHERE moderation_type=1 GROUP BY city";
$res = $mysqli->query($sql);
header("Content-Type: application/json");
$resulst = array();
$resulst['size'] = $res->num_rows;
for ($i = 1; $i <= $res->num_rows; $i++) {
    $resulst[$i] = $res->fetch_assoc();
}
echo json_encode($resulst, JSON_UNESCAPED_UNICODE);