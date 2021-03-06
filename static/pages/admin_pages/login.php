<?php
require_once "./PHP/dbconnetion.php";
$sql = "SELECT * FROM `settings` WHERE `property`='adminMail'";
$result = $mysqli->query($sql);
$adminMail = $result->fetch_assoc()['value'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/CSS/header-and-footer.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/admin-login-style.css">
    <title>Панель модератора</title>
</head>
<body>
    
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
      
          <!-- Icon -->
          <div class="fadeIn first">
            <img src="" id="icon" alt="" />
          </div>
          <?php
          if(isset($_GET['error'])){
          ?>
          <div class="alert alert-danger m-2" role="alert">
                Неверный логин или пароль!
          </div>
          <?php
          }
          ?>
          <!-- Login Form -->
          <form  method="post" action="/admin">
            <input type="text" id="login" class="fadeIn second" name="login" placeholder="Логин">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Пароль">
            <input type="submit" class="fadeIn fourth" value="Войти">
          </form>
          <?php
          if(isset($_GET['error'])){
          ?>
          <div id="formFooter">
            <a class="underlineHover" href="mailto: <?=$adminMail?>">Забыли пароль? Свяжитесь с <?php echo $adminMail ?></a>
          </div>
          <?php
          }
          ?>
        </div>
        
      </div>
<script src="JS/jquery.js"></script>
<script src="JS/bootstrap.bundle.js"></script>
</body>
</html>