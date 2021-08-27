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
    <title>Очерки</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/header-and-footer.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
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
        <span class="navbar-toggler asu-link-active">Очерки</span>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav justify-content-evenly" style="width: 100%">
                <div class="nav-item">
                    <a class="nav-link" href="/">Главная</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/history">История</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/feedback">Отзывы</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link asu-link-active" href="/essay">Очерки</a>
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
                    <button class="btn btn-outline-info col-5" onclick="closeAlert()">Отлично!</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--контент-->
<div class="container">
    <div class="row text-center gradient mt-3">
        <h1 class="display-3 fw-bold"><p>Очерки о специальности</p></h1>
    </div>
    <h2 class="row text-center">
        <p>Оглавление:</p>
        <a href="#father" class="link-primary text-decoration-none">«Отец кибернетики»</a>
        <a href="#bunny" class="link-primary text-decoration-none mt-2">Воспоминания выпускника АСУ-72-2. Натоцинская Ирина Иосифовна</a>
        <a href="#history" class="link-primary text-decoration-none mt-2">История логотипа института кибернетики</a>
    </h2>
    <hr>
    <div id="father" class="text-center justify-content-center fs-5 fst-italic mt-5" >
        <p>«Не каждый академик может похвастаться такой школой, как Евгений Иосифович Попов» —
        <br> первый аспирант-кибернетик, впоследствии кандидат и доктор технических наук  Г.П. Хамитов.</p>
        <p style="margin-top: 39px;">«Сила и значительность Евгения Иосифовича заключается в том, что его мысли и идеи<br>
        становились нашими исподволь и ненавязчиво. Свой бесценный опыт и знания он старался<br>
        реализовывать и успешно реализовывал через своих учеников»<br>
        — кандидат технических наук В.Г. Кирий.</p>
    </div>
    <div class="row fs-3 justify-content-evenly gx-2 flex-column flex-md-row align-content-center">
        <div class="col-6">
            <strong><p>Учитель с большой буквы,<br>
                «отец кибернетики» в национальном<br>
                исследовательском техническом университете —</p>
            <p style="color: #0CADC2;;">Евгений Иосифович Попов.</p></strong>
        </div>
        <div class="col-3">
            <img class="img-fluid" src="/static/imgs/Popov.png" alt="фотография: Евгений Иосифович Попов">
        </div>
    </div>
    <div class="row">
        <h2 class="fw-bold mt-5" style="color:#082AA0">Краткая биографическая справка</h2>
    </div>
    <div class="row fs-5 text-indent">
        <p>Евгений Иосифович родился в г. Макеевка Донецкой области. Окончил Ленинградский горный институт 
        в 1954 году, там же через 6 лет защитил кандидатскую диссертацию.</p>
        <p>В 1957 году был направлен в Иркутский горно-металлургический институт 
        (позже Иркутский политехнический институт, Иркутский государственный технический университет, Иркутский национальный исследовательский технический университет), 
        где и работал с января 1958 года по 2009 год.</p>
        <p>В 1962  году Попову Е. И присвоено ученое звание доцента, в 1992 году ученое звание профессора. В 1993 он году избран членом-корреспондентом, 
        а в 1995 году — действительным членом Международной академии информатизации, с 1993 по 1999 г. — вице-президент Иркутского регионального отделения Международной 
        академии информатизации. В 1995 году Евгений Иосифович избран действительным членом Международной академии науки и практики организации производства (МАОП) и 
        членом ее президиума и в этом же году — председателем Бюро Иркутского регионального отделения МАОП. В 2001 году Президиум МАОП избирает Е.И. Попова своим полномочным 
        представителем по Сибири и Дальнему Востоку.</p>
        <p>Умер Евгений Иосифович в августе 2009 года.</p>
    </div>
    <div class="row">
        <h2 class="fw-bold mt-5" style="color:#082AA0">Грани творческой личности</h2>
    </div>
    <div class="row fs-5 text-indent">
        <div class="col">
            <p>Евгений Иосифович Попов был человек эрудированный, интеллигентный, разносторонне образованный, мудрый, доброжелательный, беспредельно уважающий коллег, студентов, 
            собеседников, требовательный, но добрый, видящий в каждом своеобразие, индивидуальность, потенциальные способности и самые лучшие человеческие качества. Он  
            <b>безгранично доверял  людям</b>, прощал им непонимание и неверие, критику и осуждение. Всеми, кто с ним общался, Попов Е. И. запомнился  как удивительный человек, 
            настоящий ученый,  величайший гуманист, педагог,  дающий  не просто знания, а пробуждающий интерес к самому процессу познания. 
            <p>Как <b>человек творческий</b> он постоянно находился в процессе создания чего-либо нового. Очень сложный, порой парадоксальный, всегда избегающий однообразия и рутины, порою 
            недоступный для понимания, но всегда доступный для общения.</p>
            <p><b>Попова нужно было знать долго.</b> Его идеи и проекты на ранней стадии многими часто воспринимались как мечты и фантазии, Но проходило лет 10 и они становились понятными, 
            логичными и общепринятыми.</p>
            <p>Сегодня в почете узкая специализация, он же, напротив, любил и умел сочетать знания из различных сфер, синтезировать новые идеи,  был большим популяризатором типизации 
            и унификации.</p>   
        </div>
        <div class="col">
            <p>Как человек с большим творческим потенциалом никогда не придерживался стандартного, общепринятого  распорядка дня. Его «стандартом» была работа круглые сутки 
            <b>(от и после)</b>.</p>
            <p>Всегда находясь в кругу людей и в гуще события, по сути, он был ученым-одиночкой. 
            Проблемы, трудности и преграды в работе становились для него катализатором для создания (генерации) новых идей, принятия нестандартных решений, а не поводом для 
            сокрушений.</p>
            <p>Можно сказать, что Попов был <b>ненасытно любознателен</b> и  всю жизнь сохранял интерес первооткрывателя.</p>
            <p>Помимо плановой научно-исследовательской и учебной работы, Попов постоянно работал над новыми направлениями, до поры до времени, что называется «в стол», имея для 
            этого свою внутреннюю мотивацию, руководствуясь <b>внутренним желанием и побуждением</b>, а не стремлением к внешнему вознаграждению или признанию.</p>
            <p class="mt-1"><strong>Эта его работа в конечном итоге помогала ему, его коллегам и ученикам выйти за пределы привычного видения научных и учебных проблем.</strong></p>   
        </div>
    </div>
    <div class="text-center justify-content-center mt-3 fst-italic fs-5 ">
        <p>Общение с коллегами, аспирантами, студентами, передача им знаний<br>
        и опыта — призвание профессора Е.И. Попова, которому он отдавался  с<br>
        любовью и большой ответственностью, 
        пользуясь при этом взаимностью<br>
        и благодарностью его учеников.</p>
    </div>
    <div class="row">
        <h2 class="fw-bold mt-5" style="color:#082AA0">Основные направления научной, педагогической<br> и научно-практической 
        деятельности</h2>
        <h4>Условно можно выделить два основных направления деятельности Попова Е. И.</h4>
    </div>
    <div class="row fs-5 text-indent">
        <div class="col ">
            <p><b style="color: #0CADC2">1.</b> Разработка методов оценки точности изображения сложных топографических поверхностей по ограниченному числу данных (1952-1965 гг.) 
            и развитие теории информации применительно к задачам геометризации и разведки полезных ископаемых (1960-1965 гг.).
            <b>Итогом этого периода являются широко известные работы по геометризации месторождений угольных, слюдяных, золоторудных и других месторождений полезных ископаемых.</b><br> 
            Его идеи и полученные результаты в этой области актуальны и сегодня. Они нашли широкое отражение в учебниках, в частности, широко известном третьем (1962 г.) и 
            четвертом (1974 г.) издании учебника «Горная геометрия» проф. И.Н. Ушакова, учебных пособиях для студентов горных и геологических специальностей «Маркшейдерское дело», 
            «Геологическая съемка, поиски и разведка месторождений полезных ископаемых», «Геофизические методы поисков и разведки месторождений полезных ископаемых», включены в  
            учебные планы подготовки специалистов по этим специальностям, используются и развиваются в многочисленных кандидатских и докторских диссертациях.</p>
        </div>
        <div class="col">
            <p><b style="color: #0CADC2">2.</b> С 1963 года педагогическая и научная работа Попова Е.И. сосредоточена в области проблем кибернетики, им <b>создана научная школа в 
                области теоретических и практических проблем организации производственных систем</b> и управления ими.</p>
                <img class="img-fluid" src="/static/imgs/essays.png" alt="фотография: курирование">   
        </div>
    </div>
    <div class="text-center justify-content-center fs-4 mt-3 fw-bold">
        <p>«Постоянно чувствуешь, что знаешь меньше, чем следовало бы» —<br>
            профессор Е.И. Попов.</p>
    </div>
    <div id="bunny" class="row">
        <h1 class="mt-5 fw-bold" style="color: #0CADC2;;">Воспоминания выпускника АСУ-72-2. Натоцинская Ирина Иосифовна</h1>  
    </div>
    <div class="row mt-3 fs-5 text-indent">
    <div class="row flex-column flex-md-row fs-5 mt-3 text-indent" >
        <div class="col-12 col-md-6">
        <p>Почти 20 лет работы в родном Политехе в ОНИЛ АСУП, АСУ ВУЗ, ОСОиУ, затем в НПП ВЕДЫ обследовала, проектировала и внедряла  АСУП на предприятиях Минэлектротехпрома, и подразделениях вуза; разрабатывала генеральные схемы экономики, организации и управления производственными системами для предприятий и организаций различных отраслей.</p>
        <p>Шесть лет перестройки работала на ОАО «Кедр» в отделе экономики и планирования занималась аналитической деятельностью. Шесть лет отдала госслужбе в Управление ФНС России по Иркутской области и УОБАО, где занималась организацией работ по модернизации налоговых органов региона, включая совершенствование структуры организации и управления, внедрением современных информационных технологий. Последующие 7 лет работала в НПФ "Форус", ООО"Виста" , ЗАО "Статегические бизнес системы" в проектах SAP по корпоративным финансам.</p>
<p>Всю жизнь работаю по специальности, полученной в Alma Mater, и исповедую системный подход и принципы командной работы. Объездила половину Советского Союза и четверть мира. </p>
                  </div>
        <div class="col-10 col-md-6">
            <img class="img-fluid" src="/static/imgs/asu-72.jpg" alt="фотография: АСУ-72">   
        </div>   
    </div>
        
        
<div class="text-center justify-content-center mt-3 fst-italic fs-5">
    <p>Главной удачей в жизни считаю многолетнюю работу и общение с Евгением Иосифовичем Поповым в созданном им коллективе.</p>
</div>
<p>Основной особенностью обучения на кафедре была совместная практическая работа преподавателей и студентов в общих больших проектах. Так преподаватели обогащали теорию практическим опытом, а студенты применяли знания в реальных проектах, воспринимали изучаемые предметы в комплексе, как единую систему методов, применяемых на всех этапах проектирования и внедрения систем, получали навыки работы в коллективе общения с заказчиками и видели результаты»</p>
    <div class="row flex-column flex-md-row fs-5 mt-3 text-indent" >
        <div class="col-12 col-md-6">
            <p><strong><p>Вот так спустя много лет выглядят наши выращенные и воспитанные кафедрой Т-образные личности.</p></strong></p>
        </div>
        <div class="col-10 col-md-6">
            <img class="img-fluid" src="/static/imgs/asu-72last.JPG" alt="фотография: АСУ-72">   
        </div>   
    </div>
    <p>Мои однокурсники освоили огромную территорию  от Сахалина до Питера, от Забайкалья и  Алтая до Подмосковья, от Израиля до Скандинавии.  Ребята нашего потока АСУ-72, благодаря  глубоким и разнообразным знаниям, владением методологией системного подхода и навыкам практической  коллективной и самостоятельной работы, полученным за годы учебы,  заняты сопровождение и эксплуатацией вычислительной техники и информационных систем, программированием и проектированием, организацией и управлением в сфере производства и строительства, связи и энергетики, образования, правоохранительной, страховой и банковской деятельности.</p>

        <div class="row fs-4 mt-3">
        <p><strong>Натоцинская Ирина<br>
        АСУ-72-2</strong></p>
    </div>
    <div id="history" class="row mt-3">
        <h1 class="fw-bold" style="color: #0CADC2">Правдивые истории из студенческой жизни. Гутгарц Римма Давыдовна<br> им. Е.И. Попова</h1>  
    </div>
    <div class="row justify-content-center">
        <h2>История 1: Как мы сдавали черчение.</h2>
    </div>
    <div class="row mt-3 fs-5 text-indent">
        <p>В 1 семестре у нас была дисциплина под названием «Черчение» и по ней был дифференцированный зачет. Мы с моей подружкой Статей Звейнек ничего в нем не понимали, но зачет-то все равно сдавать надо. Поэтому мы кое-как что-то там «изобразили». Но, видимо, совсем не то, что требовалось. Преподаватель говорит Стасе: «Что же мне с Вами делать? Ну, ладно. Нарисуйте болтик». Стася что-то опять «изобразила». Преподаватель опять спрашивает: «А что Это такое? (имея в виду шайбу). Стася ей отвечает: «Шапочка». Преподаватель («хватаясь за голову» и понимая, что большего от нее не добиться), говорит: «Идите отсюда. Ставлю Вам тройку».</p>        
    </div>
    
    <div class="row justify-content-center">
        <h2>История 2: Про Гумара Павловича Хамитова</h2>
    </div>
    <div class="row mt-3 fs-5 text-indent">
        <p>У него была привычка, прежде чем стирать с доски, складывать ровненько тряпку. У нас была лекция в Б-амфитеатре. Стол там огромный, а Гумар – невысокого роста. Стоял он за столом. А тряпка почему-то была очень большая. И в тот момент, когда он ее стряхнул, его сфотографировала Света Мурзина. И получилась весьма «прикольная» фотография. На фоне доски две руки и огромная тряпка. Больше ничего. Самое интересное, что эту фотографию Гумару подарили, и он воспринял это весьма адекватно. Он вообще был человеком с юмором.</p>        
    </div>
    <div class="row justify-content-center">
        <h2>История 3: Про надписи</h2>
    </div>
    <div class="row mt-3 fs-5 text-indent">
        <p>В корпусе «Г» на первом этаже была аудитория, в которой все стены и парты были исписаны словами, оканчивающимися на «…тор» (трактор, реактор, ректор, корректор и т.д.). Мы тоже, приходя в эту аудиторию, «дописывали» недостающие слова.</p>        
    </div>

        <div class="row fs-5 mt-2">
        <p><strong>Римма Давыдовна Гутгарц,<br>
            АСУ-72-1<br>
            </p>
    </div>
    <div class="row text-center justify-content-center" style="color: #082AA0;">
        <h2><strong>Поделиться своими воспоминаниями о студенческих годах<br>
        можно на нашей странице отзывов</strong></h2>
    </div>    
    <div class="text-center justify-content-center">
        <div class="m-5">
            <button type="button" onclick="openModal(3)" class="btn btn-primary button-style">Оставить отзыв</button>
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
<script src="/JS/feedback-add.js"></script>
</body>
</html>