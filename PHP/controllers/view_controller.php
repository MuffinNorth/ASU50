<?php
    switch ($URI[0]){
        case "":
            include "./static/pages/index.php";
            break;
        case "history":
            include "./static/pages/history.html";
            break;
        case "feedback":
            include "./static/pages/feedback.html";
            break;
        case "essay":
            include "./static/pages/essay.html";
            break;
        case "archive":
            include "./static/pages/archive.html";
            break;
        default:
            include "./static/pages/404.html";
    }