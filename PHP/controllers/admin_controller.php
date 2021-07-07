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
        include_once "./static/pages/admin_pages/login.php";
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
    if($URI[1] == "edit"){
        include_once "./PHP/editFeedback.php";
    }
    if($URI[1] == "settings"){
        include_once "./static/pages/admin_pages/settings.php";
    }
    if($URI[1] == "mailing"){
        include_once "./static/pages/admin_pages/mailing.php";
    }
    if($URI[1] == "changeProperty"){
        include_once "./PHP/changeProperty.php";
    }
    if($URI[1] == "moderationEdit"){
        include_once "./PHP/moderationEdit.php";
    }
    if($URI[1] == "massSendMail"){
        include_once "./PHP/massSendMail.php";
    }
    if($URI[1] == "clearLogs"){
        include_once "./PHP/clearLog.php";
    }
    
}
else
{
    if(!$_SESSION['logindata']['isLogin']){
            if(!isset($token)){
                header('Location: /admin/login'); 
            }else{
                header('Location: /admin/login?error'); 
            }
                   
    }else{
        include "./static/pages/admin_pages/moderation.php";
    }
}



