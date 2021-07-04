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
        <a href="#bunny" class="link-primary text-decoration-none mt-2">Размышления о системных началах подготовки системотехников</a>
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
        <h1 class="mt-5 fw-bold" style="color: #0CADC2;;">Размышления о системных началах подготовки системотехников</h1>  
        <h2><strong>Воспоминания бывшего студента Асушника</strong></h2>
    </div>
    <div class="row mt-3 fs-5 text-indent">
        <p>Специальности автоматизированных систем 50 лет. Это уже настоящий юбилей, и наверное можно много интересного вспомнить о жизни и работе кибернетиков: и муки рождения, 
        и первый деканат с удивительной семейной атмосферой, и первое в институте общежитие секционного типа, и УНПК (что это?), и футбольные матчи, и КВНовские баталии 
        студенческой команды и команды под предводительством Виктора Григорьевича Кирия.</p>
        <p>Всё так, но память почему-то обращается в более далекое прошлое — к кафедре Электроники и Вычислительной Техники.</p>
        <p>Следовательно, было в нашей кафедре что-то такое, что позволило ей стать родоначальницей не одного научного направления, вычислительного центра, четырех кафедр и 
        факультета, составляющих основу автоматизации и информатизации в политехническом институте. А главное, существовало что-то необыкновенное, что заставляет нас, её 
        выпускников и воспитанников, вспоминать о ней, не существующей уже более 50 лет, с теплотой и нежностью, как о живом друге и наставнике, и отмечать её юбилеи.</p>
    </div>
    <div class="text-center justify-content-center mt-3 fst-italic fs-5">
        <p>Мне кажется, что ключевым словом, определяющим главную особенность<br> 
        нашей кафедры, была — «система», «системность».</p>
        <p class="mt-2">Стройная, глубоко продуманная система составляла основу жизни и<br>
         деятельности кафедры.</p>
    </div>
    <div class="row flex-column flex-md-row fs-5 mt-3 text-indent" >
        <div class="col-12 col-md-6">
            <p><strong>Начнем с системы формирования кафедры</strong></p>
            <div>
                <p>Евгений Иосифович подбирал людей поштучно, по профессиональным и человеческим качествам, сообразуясь с одному ему ведомым замыслом, создавая мобильную команду 
                единомышленников. И команда никогда не подводила.</p>
                <p>Еще одной системообразующей идеей была идея обязательной как для преподавателей, так и для студентов, практической деятельности, причем не просто работы по 
                отдельным хоздоговорам (как это принято на других кафедрах), а работы на один общий проект.</p>  
            </div>
        </div>
        <div class="col-10 col-md-6">
            <img class="img-fluid" src="/static/imgs/asy72.png" alt="фотография: АСУ-72">   
        </div>   
    </div>
    <div class="row mt-3 fs-5 text-indent">
        <p>Именно такая практическая деятельность обогащала преподавателей неоценимым опытом, привлекала к преподаванию специалистов-практиков, позволяла студентам применять 
        теоретические знания в реальной жизни и видеть результаты этого применения.</p>
        <p>В этом общем деле рождался уникальный, сплоченный единой идеологией коллектив, выполнявший в самых сложных условиях (при небольшой численности) объёмы работ по созданию 
        и внедрению комплексных автоматизированных систем, посильные только крупным специализированным проектным организациям.</p>
        <p>Студенты же, занятые в совместной работе, воспринимали все изучаемые предметы не разрозненно, а как систему методов, применяемых на всех этапах проектирования 
        (от обследования объектов до внедрения разработанной АСУ), а кроме того, приобретали навыки работы с предприятиями-заказчиками, учились строить взаимоотношения с 
        коллегами.</p>
        <p>Курсовые и дипломные работы студентов, выполненные в рамках общих разработок, слагались в системную проектную документацию. А выпускники, уже связанные с кафедрой 
        общей работой и общей идеологией, пополняли её ряды.</p>
        <p>Так развивалась кафедра ЭиВТ, так создавались и развивались плоть от плоти её: Отраслевая лаборатория и Вычислительный центр, являвшиеся одновременно практическими 
        и экспериментальными подразделениями и кузницей новых высококвалифицированных кадров для учебного процесса.</p>
        <p>Общность взглядов и интересов преподавателей и студентов укреплялись в командировках и походах, спортивных состязаниях и праздниках, свидетельством чему богатейший 
        студенческий фольклор.</p>     
    </div>
    <div class="row text-center justify-content-center mt-5 fs-5">
        <p>Вот так кафедра <b>«растила нас и воспитывала»</b>, так идеи системности пронизывали все наше бытие и сознание, глубоко укореняясь в Т-образной личности.</p>
        <p class="mt-2">И, спустя много лет, в непростой сегодняшней ситуации, владение методологией системного подхода помогает выпускникам кафедры осваиваться в самых 
        разных сферах деятельности.</p>
        <p class="mt-2" style=" color: #0CADC2"><strong>Хочется верить, что кафедры кибернетического центра не растратят, а преумножат накопленный прародительницей ценнейший 
        уникальный опыт системности — залог успехов в подготовке специалистов-системотехников.</strong></p>
    </div>
    <div class="row fs-4 mt-3">
        <p><strong>Натоцинская Ирина<br>
        АСУ-72-2</strong></p>
    </div>
    <div id="history" class="row mt-3">
        <h1 class="fw-bold" style="color: #0CADC2">История логотипа института кибернетики<br> им. Е.И. Попова</h1>  
    </div>
    <div class="row mt-3 fs-5 text-indent">
        <p>В сентябре 2004 года декан факультета кибернетики Александр Васильевич Петров собрал оргкомитет по подготовке к 25-летнему юбилею факультета, в который неожиданно попал я.</p>
        <p>Как известно, любой серьѐзной организации, которой, без сомнения, 
        являлся наш факультет, нужен фирменный стиль, а это, в первую очередь, логотип.</p>
        <p>Набросок этого кораблика был сделан после того, как я прочитал статью о кибернетике в «Советской энциклопедии», которая была под рукой. Были и другие варианты, такие 
        как глобус, окруженный орбитами из нулей и единиц, стилизованный персональный компьютер и много других. На одной из встреч оргкомитета мне порекомендовали выбрать кораблик 
        и посоветоваться с Евгением Иосифовичем Поповым.</p>
    </div>
    <div class="row justify-content-center">
        <img src="/static/imgs/logo1.png" class="img-fluid col-9 col-md-4" alt="нарисованный кораблик">
    </div>
    <div class="row fs-5 mt-3 text-indent">
        <p>Провожая Евгения Иосифовича до дома одним теплым осенним днем, я слушал рассказ о роли кибернетики в нашей жизни и ждал, когда же речь пойдет о логотипе, который я ему 
        показал. Перед тем как войти в подъезд, он сказал, что логотип его вполне устраивает. Я был счастлив, потому что точка наконец-то в этом вопросе была поставлена.</p>
        <p>Особую признательность я выражаю Наталье Вячеславовне Бычковой, которая помогла с помощью обычной линейки уравновесить композицию, в результате чего родился логотип 
        образца 2004 года. В 2008 году было небольшое изменение логотипа, в котором на этот раз я подчеркнул аналоговую и цифровую природу информации, так как кормчий кораблика 
        (т.е. «кибернетика») сегодня ведет его по волнам информации, пересекая различные измерения и пространства, и неустанно двигает научно-технологический прогресс вперед.</p>
    </div>
    <div class="row fs-5 mt-2">
        <p><strong>Станислав Валентинович Григорьев,<br>
            доцент кафедры<br>
            автоматизированных систем</p>
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