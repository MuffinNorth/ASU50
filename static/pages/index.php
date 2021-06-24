<?php
$first = true;
function genStarFeedback($data){
    global $first;
    $name = $data['name'];
    $group = $data['group'];
    $review = $data['review'];
    $avatar = $data['avatar_path'];
    $city = $data['city'];
    if($first){
        echo "<div class=\"carousel-item active\">";
    }else{
        echo "<div class=\"carousel-item\">";
    }
    $first = false;
    echo "<div class=\"asu-feedback-card d-flex flex-column flex-md-row\">
        <div class=\"m-3 mt-4\">
            <img class=\"asu-avatar\" src=\"/static/imgs/avatars/$avatar\">
        </div>
        <div class=\"container-fluid\">
            <div class=\"mt-3\">
                <strong>$name, $city</strong><br>
                <strong>Группа: </strong> $group
            </div>
            <hr>
            <div>
                <p>$review</p>
                </div>
        </div>
    </div>
  </div>";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/header-and-footer.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=fd857437-c7f4-46ba-a7eb-7fd55154a69a" type="text/javascript"></script>
</head>
<body>
<!--Шапка-->
<div class="asu-header d-flex justify-content-evenly align-items-center">
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
        <span class="navbar-toggler asu-link-active">Главная</span>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav justify-content-evenly" style="width: 100%">
                <div class="nav-item">
                    <a class="nav-link asu-link-active" href="/">Главная</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/history">История</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/feedback">Отзывы</a>
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

<div class="modal fade " id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModal" aria-hidden="true">
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
                    <input type="hidden" name="from" value="2" id="fromValue">
                    <div>
                        <label id="prompt" for="email">Отзыв:</label>
                        <textarea class="form-control" name="review" rows="15"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="addFeedback()" class="btn btn-primary">Отправить отзыв</button>
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
                    <button class="btn btn-outline-info col-5" onclick="closeAlert()">Отлично!</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--контент-->
<div class="container">
    <div class="mt-5 row text-center gradient">
        <h1 class="display-3 fw-bold"><p>История специальности АСУ</p></h1>
    </div>
    <div class="fs-5 mt-3">
        <p>В 60-е годы ХХ века в производственном секторе экономики Советского Союза для решения управленческих и производственных задач стали активно внедряться автоматизированные системы обработки информации на базе больших ЭВМ. Каждое крупное предприятие (и некоторые средние) имело такую вычислительную машину.</p>
        <p>Кроме того, на каждом предприятии, имеющем большую ЭВМ, обязательно был свой отдел АСУ, функции которого заключались в том, чтобы составлять программы для решения конкретных задач в определенных подразделениях предприятия (бухгалтерии, отделе сбыта, отделе снабжения, плановом отделе, отделе Главного механика, отделе кадров и др.).</p>
        <p>Таким образом, специалисты отдела АСУ находились в постоянном информационно-технологическом контакте с непосредственными заказчиками. Это способствовало оперативности решения задач и быстрому редактированию программ при необходимости.</p>
    </div>
    <div class="text-center">
        <div class="mt-2">
            <h4><p>Поскольку для отделов АСУ по всей стране требовалось много квалифицированных специалистов,<br>
            то возникла потребность в их подготовке.</p></h4>
        </div>
        <div class="mt-3 fs-3 fw-bold">
            <strong><p>Это обстоятельство послужило основанием для открытия<br>
            в ИПИ (Иркутском политехническом институте)<br>
            новой специальности —  «АСУ».</p></strong>
        </div>
        
    </div>    
</div>
<div class="container mt-5">
    <div class="text-center">
        <div>
            <h2><strong>За полвека Иркутский Политех подготовил</strong></h2>
        </div>
        <div class="mt-5" style="line-height: 351px; background: linear-gradient(180deg, #082AA0 0%, #0CADC2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; color: #0B2349;">
            <h1 class="fw-bolder giantText" >1800</h1>
        </div>
        <div class="mt-2 fw-bolder" style="color: #0CADC2;">
            <h2>специалистов специальности АСУ</h2>
        </div>
    </div>    
</div>


<div class="container">
    <div class="row text-center justify-content-center">
        <video src="/static/video/Asu_71_Ucheba_a.mp4" controls></video> 
    </div>    
</div>


<div class="container mt-5">
    <div class="row text-center justify-content-center">
        <div style="color: #082AA0;">
            <h2><strong>Наши выпускники работают по всему миру</strong></h2>
        </div>
    </div>    
</div>


<div id="map" class="container-sm" style="height: 500px;">
</div>
<div class="container text-center">
    <div class="mt-5 fw-bold" style="color: #0CADC2;">
        <h2><strong>Выпускник специальности АСУ?</strong></h2>
    </div>
    <div class="fs-5">
        <p>Тогда отметься на карте!</p>
    </div>
    <div class="text-center justify-content-center mt-2">
        <div>
            <button type="button" onclick="openModal(1)" class="btn btn-primary button-style">Отметиться</button>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="row text-center justify-content-center">
        <div>
            <h2><strong>Ты можешь оставить отзыв о специальности на нашем сайте</strong></h2>
        </div>
    </div>    
</div>

<?php
require_once "./PHP/dbconnetion.php";
$sql = "SELECT * FROM `feedbacks` WHERE favorites = 1";
$res = $mysqli->query($sql);
if($res->num_rows > 0){
?>
<div class="row d-flex justify-content-center">
    <div id="carouselExampleControls" class="carousel slide col-12 col-md-8 order-1 order-md-2" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            for($i = 0; $i < $res->num_rows; $i++){
                $data = $res->fetch_assoc();
                genStarFeedback($data);
            }
            ?>
        </div>
    </div>  
    
    <button class="carousel-dark btn btn-hide col-6 col-md-1 order-md-1 order-2" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Предыдущий</span>
    
    </button>
      <button class="carousel-dark btn btn-hide col-6 col-md-1 order-3" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Предыдущий</span>
      </button>
</div>
<?php
}
?>


<div class="container mt-5">
    <div class="row text-center justify-content-center">
        <div class="fs-4">
            <p>Расскажи о своей работе, поделись воспоминаниями о студенческих<br> 
            годах, поздравь специальность с юбилеем, присоединяйся к сообществу<br> 
            выпускников</p>
        </div>
    </div>    
    <div class="text-center m-5 justify-content-center">
        <div>
            <button type="button" onclick="openModal(2)" class="btn btn-primary button-style">Оставить отзыв</button>
        </div>
    </div>
</div>
<!--Подвал-->
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
<script src="/JS/bootstrap.bundle.js"></script>
<script src="/JS/jquery.js"></script>
<script src="/JS/asu-map.js"></script>
<script src="/JS/feedback-add.js"></script>
</body>
</html>