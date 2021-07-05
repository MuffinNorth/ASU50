
<?php
require_once "./PHP/controllers/log_controller.php";
$sql = "SELECT value FROM `settings` WHERE property='feedbackMessageTitle' ";
$result = $mysqli->query($sql);
$title = $result->fetch_assoc()['value'];

$sql = "SELECT value FROM `settings` WHERE property='acceptMessage' ";
$result = $mysqli->query($sql);
$acceptMessage = $result->fetch_assoc()['value'];

$sql = "SELECT value FROM `settings` WHERE property='denyMessage' ";
$result = $mysqli->query($sql);
$denyMessage = $result->fetch_assoc()['value'];

$sql = "SELECT value FROM `settings` WHERE property='footerMessage' ";
$result = $mysqli->query($sql);
$footerMessage = $result->fetch_assoc()['value'];
?>
<div class="container mt-5">
    <div class="card">
        <h5 class="card-header">Шаблоны письма автоответчика</h5>
        <div class="card-body">
            <div class="alert alert-primary" role="alert">
                Обратите внимание, что для форматирование текста сообщения, Вы, можете использовать следующие ключевые слова:
                <ul >
                    <li><b>%name%</b> - заменяется на <b>имя</b> получателя</li>
                    <li><b>%city%</b> - заменяется на <b>город</b> получателя</li>
                    <li><b>%group%</b> - заменяется на <b>группу</b> получателя</li>
                    <li><b>%email%</b> - заменяется на <b>почту</b> получателя</li>
                </ul>
            </div>
            <div>
                <label for="mail">Заголовок писем для автоответа:</label>
                <input type="text" class="form-control in-stitle"  onkeyup="textUpdate()" value="<?php
                echo $title;
                ?>">
            </div>
            <div>
                <label for="mail">Текст письма на одобрение отзыва:</label>
                <textarea class="form-control in-atext" name="mail" rows="5" onkeyup="textUpdate()"><?php
                echo $acceptMessage;
                ?> </textarea>
            </div>

            <div>
                <label for="mail">Текст письма на отклонение отзыва:</label>
                <textarea class="form-control in-dtext" name="mail" rows="5" onkeyup="textUpdate()"><?php
                echo $denyMessage;
                ?> </textarea>
            </div>

            <div>
                <label for="mail">Текст подвала для писем (<span class="text-danger">ключевые слова не поддерживаются</span>):</label>
                <textarea class="form-control in-ftext" name="mail" rows="5" onkeyup="textUpdate()"><?php
                echo $footerMessage;
                ?> </textarea>
            </div>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Предпросмотр шаблонов писем автоответчика</h5>
        <div class="card-body">
            <div>
                <label for="mail">Заголовок писем для автоответа:</label>
                <input type="text" class="form-control out-stitle"  disabled>
            </div>
            <div>
                <label for="mail">Текст письма на одобрение отзыва:</label>
                <textarea class="form-control out-atext" name="mail" rows="5" disabled></textarea>
            </div>

            <div>
                <label for="mail">Текст письма на отклонение отзыва:</label>
                <textarea class="form-control out-dtext" name="mail" rows="5" disabled></textarea>
            </div>

            <div>
                <label for="mail">Текст подвала для писем:</label>
                <textarea class="form-control out-ftext" name="mail" rows="5" disabled></textarea>
            </div>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Действия</h5>
        <div class="card-body">
        <button class="btn btn-success" onclick="updateShablon()">Сохранить</button>
        </div>
    </div>
</div>

