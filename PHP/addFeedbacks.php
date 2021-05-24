<?php
include_once("./PHP/dbconnetion.php");
$updloaddir = "./static/imgs/avatars/";
header("Content-Type: application/json");
    if( isset($_POST['name']) and
        isset($_POST['email']) and
        isset($_POST['group']) and
        isset($_POST['city']))
    {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $group = $_POST["group"];
        $city = $_POST["city"];
        if(isset($_POST["workplace"]))
        {
            $workplace = $_POST["workplace"];
        }else{
            $workplace = "Не указано";
        }
        $review = $_POST["review"];
        if(isset($_FILES["avatar"])){
            $avatarname =  rand() . basename($_FILES['avatar']['name']);
            $uploadfile = $updloaddir . $avatarname;
            if(move_uploaded_file($_FILES["avatar"]['tmp_name'], $uploadfile)){
                $avatar = $avatarname;
            }else{
                $avatar = 'default.svg';
            }
        }
        else{
            $avatar = 'default.svg';
        }
        $from = $_POST["from"];
        $sql = "INSERT INTO `feedbacks` (`id`, `name`, `group`, `review`, `city`, `workplace`, `email`, `avatar_path`, `from`, `moderation_type`, `favorites`) VALUES (NULL, '$name', '$group', '$review', '$city', '$workplace', '$email', '$avatar', '$from', '0', b'0')";
        $res = $mysqli->query($sql);
        echo json_encode($res);
    }
    else{
        echo json_encode(false);
    }
