<?php
require_once "./PHP/controllers/log_controller.php";
$sql = "SELECT * FROM `settings` WHERE `property`='adminMail'";
$result = $mysqli->query($sql);
$adminMail = $result->fetch_assoc()['value'];
$sql = "SELECT * FROM `settings` WHERE `property`='openToFeeds'";
$result = $mysqli->query($sql);
$openToFeeds = $result->fetch_assoc()['value'];
?>


<div class="container mt-5">
    <div class="card">
    <h5 class="card-header">Настройки отзывов</h5>
    <div class="card-body">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="openToFeedsSwitch" onchange="onSwitch()" <?php
            if($openToFeeds == "true"){
                echo "checked";
            }
            ?>>
            <label class="form-check-label" for="openToFeedsSwitch">Прием отзывов</label>
        </div>
        <label class=" mt-3" for="adminEmail">Email главного администратора:</label>
        <div class="input-group">
            <input type="text" id="adminEmail" class="form-control" placeholder="Email" value="<?php
            echo $adminMail;
            ?>">
            <span class="mx-1 input-group-btn">
             <button class="btn btn-outline-secondary" type="button">Изменить</button>
            </span>
            <span class="input-group-btn">
             <button class="btn btn-outline-secondary" type="button">Сбросить</button>
            </span>

        </div>
    </div>
    </div>
</div>

