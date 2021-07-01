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
      <a class="navbar-brand" href="#">Панель модератора</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a id='await' class="nav-link" aria-current="page" href="#Ожидающие" onclick="changeTypeOfFeedbacks(0)">Ожидающие <span class="badge bg-secondary" id="count"></span></a>
          </li>
          <li class="nav-item">
            <a id='public' class="nav-link " aria-current="page" href="#Опубликованные" onclick="changeTypeOfFeedbacks(1)">Опубликованные</a>
          </li>
          <li class="nav-item">
            <a id='can' class="nav-link" aria-current="page" href="#Корзина" onclick="changeTypeOfFeedbacks(2)">Корзина</a>
          </li>
          <li><a class="nav-link" href="/admin/settings">Параметры сервера</a></li>
          <li><a class="nav-link" href="/admin/mailing">Рассылка</a></li>
        </ul>
        <form class="" action="/admin/logout">
          <button class="btn btn-outline-danger me-2" type="submit">Выход</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="feedbackModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header asu-footer">
                <h5 class="modal-title" id="labelEdit">Редактировать отзыв </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="feedForm" class="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Имя и фамилия*:</label>
                            <input class="form-control m-2" type="text" placeholder="Ваше имя и фамилия" name="name" id="mname">
                        </div>
                        <div class="col-6">
                            <label for="email">Электронная почта*:</label>
                            <input class="form-control m-2" type="email" placeholder="Ваш email" name="email" id="memail">  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Город*:</label>
                            <input class="form-control m-2" type="text" placeholder="Город" name="city" id="mcity">
                        </div>
                        <div class="col-6">
                            <label for="email">Место работы:</label>
                            <input class="form-control m-2" type="email" placeholder="Место работы" name="workplace" id="mworkplace">  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Группа*:</label>
                            <input class="form-control m-2" type="text" placeholder="Группа" name="group" id="mgroup">
                        </div>
                        <div class="col-6">
                            <label for="email">Фотография:</label>
                            <input class="form-control m-2" type="file" disabled>
                        </div>
                    </div>
                    <input type="hidden" name="from" value="0">
                    <input type="hidden" name="id" value="0" id="mid">
                    <div>
                        <label for="email">Отзыв:</label>
                        <textarea class="form-control" name="review" rows="10" id="mreview"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="updateFeedback()" class="btn btn-primary">Отправить отзыв</button>
            </div>
        </div>
    </div>
  </div>
  <div id="feedholder" class="d-flex justify-content-center flex-column align-items-center">

  </div>
<script src="/JS/jquery.js"></script>
<script src="/JS/bootstrap.bundle.js"></script>
<script src="/JS/toast.js"></script>
<script src="/JS/moderation.js"></script>
</body>
</html>