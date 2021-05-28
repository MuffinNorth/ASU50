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
    <script type="text/javascript">
    var username ='<?php echo $_SESSION['logindata']['username'];?>';
    var token ='<?php echo $_SESSION['logindata']['token'];?>';
    </script>
    <title>Панель модератора</title>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Панель модератора</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a id='await' class="nav-link" aria-current="page" href="#">Ожидающие</a>
          </li>
          <li class="nav-item">
            <a id='public' class="nav-link " aria-current="page" href="#">Опубликованные</a>
          </li>
          <li class="nav-item">
            <a id='can' class="nav-link" aria-current="page" href="#">Корзина</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Настройки
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Модераторы</a></li>
              <li><a class="dropdown-item" href="#">Параметры сервера</a></li>
              <li><a class="dropdown-item" href="#">Логи</a></li>
            </ul>
          </li>
        </ul>
        <form class="" action="/admin/logout">
          <button class="btn btn-outline-danger me-2" type="submit">Выход</button>
        </form>
      </div>
    </div>
  </nav>  
  <main >
    <div>

    </div>
  </main>
<script src="JS/jquery.js"></script>
<script src="JS/bootstrap.bundle.js"></script>
<script src="/JS/moderation.js"></script>
</body>
</html>