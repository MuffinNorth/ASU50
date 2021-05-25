<?php
session_start();
if(!isset($_SESSION['logindata'])){
    $_SESSION['logindata'] = [
        'username' => 'None',
        'token' => 'None',
        'isLogin' => false,
    ]; 
}

if(!$_SESSION['logindata']['isLogin']){
    include_once "./static/pages/admin_pages/login.html";
}
