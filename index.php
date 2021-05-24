<?php
    $URI = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $URI = explode('/', trim($URI, '/'));
    if($URI[0] == "admin"){
        include_once "PHP/controllers/admin_controller.php";
    }elseif ($URI[0] == "api"){
        include_once "PHP/controllers/api_controller.php";
    } else{
        include_once "PHP/controllers/view_controller.php";
    }

