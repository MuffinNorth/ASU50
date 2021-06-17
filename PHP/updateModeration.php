<?php
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $current_hash = "1111"; // MYSQLI
    $password = "";
    if(password_verify($current_hash, $current_hash)){
        $password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    }
}else{
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
}
?>