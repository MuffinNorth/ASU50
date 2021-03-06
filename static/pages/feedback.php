<?php
require_once "./PHP/controllers/log_controller.php";
$sql = "SELECT * FROM `settings` WHERE `property`='adminMail'";
$result = $mysqli->query($sql);
$adminMail = $result->fetch_assoc()['value'];
$sql = "SELECT * FROM `settings` WHERE `property`='openToFeeds'";
$result = $mysqli->query($sql);
$openToFeeds = $result->fetch_assoc()['value'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отзывы</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/header-and-footer.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<!--Шапка-->
<div id="scrollUp" class="asu-header d-flex justify-content-evenly align-items-center">
    <div class="asu-header-title">
        50-летие<br>
        специальности<br>
        «Автоматизированные<br>
        системы управления»
    </div>
    <div class="col-2 d-none d-sm-block">
    </div>
    <div class="asu-header-logo d-none d-sm-block">
    </div>
</div>
<!--Навигационная панель-->
<header class="asu-navbar sticky-top navbar navbar-expand-sm navbar-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="navbar-toggler asu-link-active">Отзывы</span>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav justify-content-evenly" style="width: 100%">
                <div class="nav-item">
                    <a class="nav-link" href="/">Главная</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/history">История</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link  asu-link-active" href="/feedback">Отзывы</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/essay">Очерки</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/archive">Медиаархив</a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="modal fade " <?php
if($openToFeeds == "true"){
    echo 'id="feedbackModal"';
}
?> tabindex="-1" aria-labelledby="feedbackModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header asu-footer">
                <h5 class="modal-title" id="exampleModalLabel">Написать свой отзыв</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="feedForm" class="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Имя и фамилия*:</label>
                            <input class="form-control m-2" type="text" id="name" placeholder="Ваше имя и фамилия" name="name">
                        </div>
                        <div class="col-6">
                            <label for="email">Электронная почта*:</label>
                            <input class="form-control m-2" type="email" id="email" placeholder="Ваш email" name="email">  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Город*:</label>
                            <input class="form-control m-2" type="text" id="city" placeholder="Город" name="city">
                        </div>
                        <div class="col-6">
                            <label for="email">Место работы:</label>
                            <input class="form-control m-2" type="email" placeholder="Место работы" name="workplace">  
                        </div>
                    </div>
                    <div class="row flex-row justify-content-between">
                        <div class="col-5 mt-2 ms-2">
                            <label for="name">Группа*:</label>
                            <select id="group" class="form-control" name="group">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="email">Фотография:</label>
                            <input class="form-control m-2" type="file"  name="avatar">
                        </div>
                    </div>
                    <input type="hidden" name="from" value="0">
                    <div>
                        <label for="email">Отзыв:</label>
                        <textarea class="form-control" name="review" rows="12"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="addFeedback()" class="btn btn-primary">Отправить отзыв</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" <?php
if($openToFeeds == "false"){
    echo 'id="feedbackModal"';
}
?> aria-hidden="true" aria-labelledby="alertModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content asu-feedback-modal">
            <div class="modal-body">
                <div class="row text-center">
                    <h2 class="mb-4 asu-megatitle"><strong>Извините! </strong></h2>
                    <p>
                        Прием отзывов в данный момент закрыт! В случае необходимости просим вас обратиться к администратору: <a href="mailto:<?php
                        echo $adminMail;
                        ?>"><?php
                        echo $adminMail;
                        ?></a>
                    </p>
                </div>
                <br>
                <div class="row justify-content-center">
                    <button class="btn btn-outline-info col-5 " data-bs-dismiss="modal">Хорошо</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="alertModal" aria-hidden="true" aria-labelledby="alertModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content asu-feedback-modal">
            <div class="modal-body">
                <div class="row text-center">
                    <h2 class="mb-4 asu-megatitle"><strong>Спасибо!</strong></h2>
                    <p>
                        Спасибо! Ваш отзыв отправлен на модерацию. Если всё в порядке, после проверки он появится на странице отзывов.
                    </p>
                </div>
                <br>
                <div class="row justify-content-center">
                    <button class="btn btn-outline-info col-5 " onclick="closeAlert()">Отлично!</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="fixedButton" onclick="openModal()">
    <span>+</span>
</div>

<div class="container-fluid">
    <div class="row justify-content-center text-center my-3">
        <div class="asu-feedback-title col-11 col-sm-6 col-md-5 col-lg-4" style="cursor: pointer" onclick="openModal()">
            <h2><strong>Написать свой отзыв</strong></h2>
        </div>
    </div>
    <div class="row justify-content-evenly">
        <a href="feedback?sort=new" class="col-auto nav-link" id="s_new">
            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
            Сортировать по новым
        </a>
        <a href="feedback?sort=old" class="col-auto nav-link" id="s_old">
            <i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>
            Сортировать по старым
        </a>
    </div>

    <div class="">
        <div class="row justify-content-center" id="placeholder">
            <div class="spinner-border my-4" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Загрузка...</span>
              </div>
        </div>
        <nav class="d-flex justify-content-center">
            <ul class="pagination" id="pages">
            </ul>
        </nav>
    </div>
</div>
<footer class="asu-footer d-flex flex-column flex-md-row justify-content-center justify-content-md-evenly align-items-baseline align-items-md-center pt-0 pt-md-4 pb-0 pb-md-4">
    <div class="m- m-md-0">
        <strong>Контакты дирекции Института ИТиАД:</strong><br>
        664074, г. Иркутск, ул. Лермонтова 83<br>
        <strong>Офис:</strong> ауд. В-210<br>
        <strong>Телефон:</strong> +7 (3952) 40-51-60<br>
        <strong>E-mail:</strong> <a class="link-light" href="mailto:itda@istu.edu">itda@istu.edu</a><br>
        <strong>Часы работы:</strong> 09:00-17:00<br>
    </div>
    <br>
    <div class="m-2 m-md-0">
        <strong>Сайт ИРНИТУ:</strong><br>
        <a class="link-light" href="http://www.istu.edu">http://www.istu.edu</a><br>
        <br>
        <strong>ИИТиАД Вконтакте:</strong><br>
        <a class="link-light" href="https://vk.com/itds_istu">https://vk.com/itds_istu</a><br>
    </div>
    <br>
    <div class="d-flex justify-content-between m-2 m-md-0">
        <div class="iPolitech mx-2"></div>
        <div class="itiad mx-2"></div>
    </div>
</footer>

<script src="/JS/jquery.js"></script>
<script src="https://use.fontawesome.com/61c29c7e04.js"></script>
<script src="/JS/bootstrap.bundle.js"></script>
<script src="/JS/feedback.page.js"></script>
</body>
</html>