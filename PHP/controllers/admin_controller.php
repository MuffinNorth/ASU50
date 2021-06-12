<?php
require_once "./PHP/controllers/login_controller.php";
require_once "./PHP/controllers/log_controller.php";
session_start();

if(isset($_POST['login']) and isset($_POST['password'])){
    $token = login($_POST['login'], $_POST['password']);
    if($token){
        $_SESSION['logindata'] = [
            'username' => $_POST['login'],
            'token' => $token,
            'isLogin' => true
        ];
    }
}

if(!isset($_SESSION['logindata'])){
    $_SESSION['logindata'] = [
        'username' => 'None',
        'token' => 'None',
        'isLogin' => false,
    ]; 
}


if(isset($URI[1])){
    if($URI[1] == "login" ){
        include_once "./static/pages/admin_pages/login.html";
    }
    elseif($URI[1] == "logout"){
        write_log($_SESSION['logindata']['username'], "Вышел из панели модератора");
        $_SESSION['logindata'] = [
            'username' => 'None',
            'token' => 'None',
            'isLogin' => false,
        ]; 
        header('Location: /admin/login');
    }
    if($URI[1] == "accept"){
        include_once "./PHP/acceptFeedback.php";
    } 
    if($URI[1] == "deny"){
        include_once "./PHP/denyFeedback.php";
    }
    if($URI[1] == "delete"){
        include_once "./PHP/deleteFeedback.php";
    }
    if($URI[1] == "star"){
        include_once "./PHP/starFeedback.php";
    }
    
}
else
{
    if(!$_SESSION['logindata']['isLogin']){
        header('Location: /admin/login');
    }else{
        include "./static/pages/admin_pages/moderation.php";
    }
}



