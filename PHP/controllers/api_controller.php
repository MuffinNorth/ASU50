<?php
include_once "./PHP/dbconnetion.php";
if(isset($URI[1])){
    if($URI[1] == "getFeedbacks"){
        include "./PHP/getFeedbacks.php";
    }elseif ($URI[1] == "addFeedback"){
        include "./PHP/addFeedbacks.php";
    }
    elseif ($URI[1] == "aGetFeedbacks"){
        include "./PHP/adminGetFeedbacks.php";
    }
    else{
        echo "404";
    }
}
