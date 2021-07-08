<?php
$fromEmail = "admin@projfair.tw1.ru";
$name = "Администратор";
include_once("./PHP/dbconnetion.php");
include_once("./PHP/controllers/formater_controller.php");
function sendMail($sbj, $title, $content, $ctx){
    global $name;
    global $fromEmail;
    $to = $sbj;
    if($ctx != null){
        $subject = format_by_ctx($ctx, $title);
        $message = format_by_ctx($ctx, $content);
    }else{
        $subject = $title;
        $message = $content;
    }
    $mailheaders = "Content-type:text/plain;charset=utf-8 \r\n";
    $mailheaders .= "From: $name <$fromEmail> \r\n";
    $mailheaders .= "Reply-To: $fromEmail \r\n";
    global $mysqli;
    $sql = "SELECT value FROM `settings` WHERE property='footerMessage'";
    $footer = $mysqli->query($sql)->fetch_assoc()['value'];
    realSendMail($to, $subject, $message ."\r\n". $footer, $mailheaders);
}
function realSendMail($sbj, $title, $content, $mailheaders){
    $msg = wordwrap($content, 70, "\r\n");
    mail($sbj, $title, $msg, $mailheaders);
}

function fakeSendMail($sbj, $title, $content, $mailheaders){
    $fp = fopen('mailto.txt', 'a'); // Текстовый режим
    fwrite($fp,"\n-----------------------Новое сообщение---------------------------- \n" . "Кому:" . $sbj . "\r\n" . "Тема:" . $title . "\r\n" . "Текст:" . $content);
    fclose($fp);
}



?>