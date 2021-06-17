<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/CSS/header-and-footer.css" type="text/css">
    <link rel="stylesheet" href="/CSS/toast.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script type="text/javascript">
    var username ='<?php echo $_SESSION['logindata']['username'];?>';
    var token ='<?php echo $_SESSION['logindata']['token'];?>';
    </script>
    <title>Панель модератора</title>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Параметры сервера</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/admin">Отзывы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/admin/settings">Параметры сервера</a>
          </li>
        </ul>
        <form class="" action="/admin/logout">
          <button class="btn btn-outline-danger me-2" type="submit">Выход</button>
        </form>
      </div>
    </div>
  </nav>
  <div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Модераторы</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Настройки сайта</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Логи</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
         <?php include "./PHP/editModer.php" ?>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <?php include "./PHP/serverSettings.php" ?>
      </div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="container my-2">
         <?php include "./PHP/formModer.php" ?>
        </div>
      </div>
    </div>

  </div>
  
<script src="/JS/jquery.js"></script>
<script src="/JS/bootstrap.js"></script>
<script src="/JS/toast.js"></script>

</body>
</html>