<?php
$count = 1;
function genModer($id, $who, $email){
    global $count;
    echo "<tr>";
    echo "<th scope=\"row\">$count</th>";
    echo "<td>$who</td>";
    echo "<td>$email</td>";
    echo "<td  class=\"al-right\">
    <a class=\"btn btn-warning\" href=\"/admin/settings?edit=$id\">
    Редактировать
    </a>
    <button onclick=\"delModer($id, '$who')\" class=\"btn btn-danger\">
    Удалить
    </button>
    
    </td>";
    echo "</tr>";
    $count++;
}
require_once "./PHP/controllers/log_controller.php";
$sql = "SELECT * FROM `admins`";
$result = $mysqli->query($sql);
?>
<div class="container mt-3">
    
    <?php
    if(isset($_GET['goodCreate'])){
        echo "<div class=\"card mt-1\">
        <h5 class=\"card-header\">Информационное окно</h5>
        <div class=\"card-body text-center\">
        <h2>Модератор был успешно создан!</h2>
        </div>
        </div>";
    }elseif(isset($_GET['badCreate'])){
        echo "<div class=\"card mt-1\">
        <h5 class=\"card-header\">Информационное окно</h5>
        <div class=\"card-body text-center \">
        <h2>Модератор с таким логином уже существует!</h2>
        </div>
        </div>";
    }elseif(isset($_GET['goodUpdate'])){
        echo "<div class=\"card mt-1\">
        <h5 class=\"card-header\">Информационное окно</h5>
        <div class=\"card-body text-center\">
        <h2>Модератор был успешно обновлен!</h2>
        </div>
        </div>";
    }elseif(isset($_GET['delete'])){
        echo "<div class=\"card mt-1\">
        <h5 class=\"card-header\">Информационное окно</h5>
        <div class=\"card-body text-center\">
        <h2>Модератор был успешно удален!</h2>
        </div>
        </div>";
    }
    ?>

    <div class="card mt-3">
    <h5 class="card-header"><?php
            if(isset($_GET['edit'])){
                echo "Обновить модератора";
            }else{
                echo "Добавить модератора";
            }
            ?></h5>
    <div class="card-body">
        <form class="row g-3 needs-validation" method="POST" action="/admin/moderationEdit" novalidate>
            <?php
            if(isset($_GET['edit'])){
                $id = $_GET['edit'];
                $sql = "SELECT * FROM `admins` WHERE `id`='$id'";
                $user = $mysqli->query($sql);
                $user = $user->fetch_assoc();
                echo "<input type=\"hidden\" class=\"form-control\" id=\"ID\" name=\"ID\" value=\"$id\">";
            }
            ?>
            
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Логин</label>
                <?php
                if(isset($_GET['edit'])){
                    $login = $user['login'];
                    echo "<input type=\"text\" class=\"form-control\" id=\"validationCustom01\" name=\"flogin\" required value=\"$login\">";
                }else{
                    echo "<input type=\"text\" class=\"form-control\" id=\"validationCustom01\"  name=\"flogin\" required>";
                }
                ?>
                
                <div class="valid-feedback">
                    Хорошо!
                </div>
                <div class="invalid-feedback">
                    Пожалуйста введите логин!
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Email</label>
                <?php
                if(isset($_GET['edit'])){
                    $email = $user['email'];
                    echo "<input type=\"text\" class=\"form-control\" id=\"validationCustom02\"  name=\"email\"  required value=\"$email\">";
                }else{
                    echo "<input type=\"text\" class=\"form-control\" id=\"validationCustom02\"  name=\"email\"  required>";
                }
                ?>
                
                <div class="valid-feedback">
                    Хорошо!
                </div>
                <div class="invalid-feedback">
                    Пожалуйста введите почту!
                </div>
            </div>
            <div class="col-md-4">
                <?php
                if(isset($_GET['edit'])){
                    echo "<label for=\"validationCustom01\" class=\"form-label\">Новый пароль</label>";
                    echo "<input type=\"password\" class=\"form-control\"  name=\"password\"  id=\"validationCustom03\">";
                }else{
                    echo "<label for=\"validationCustom01\" class=\"form-label\">Пароль</label>";
                    echo "<input type=\"password\" class=\"form-control\"  name=\"password\"   id=\"validationCustom03\" required>";
                }
                ?>
                <div class="valid-feedback">
                    Хорошо!
                </div>
                <div class="invalid-feedback">
                    Пожалуйста введите пароль!
                </div>
            </div>
            <div class="col-12">
                <?php
                if(isset($_GET['edit'])){
                    echo "<button class=\"btn btn-primary mx-1 \" type=\"submit\">Обновить</button>";
                    echo "<a class=\"btn btn-info\" href=\"/admin/settings\">Очистить поля</a>";
                }else{
                    echo "<button class=\"btn btn-primary mx-1 \" type=\"submit\">Создать</button>";
                }
                ?>
                
            </div>
        </form>
    </div>
    </div>

    <div class="card mt-1">
    <h5 class="card-header">Список модераторов</h5>
    <div class="card-body">
    <table class="table table-striped table-bordered table-hover table-responsive" style="">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Логин</th>
            <th scope="col">Почта</th>
            <th scope="col"  class="al-right">Функции</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for($i = 0; $i < $result->num_rows; $i++){
                $r = $result->fetch_assoc();
                genModer($r['id'], $r['login'], $r['email']);
            }
            ?>
        </tbody>
    </table>
    </div>
    </div>
</div>

<script>
    (function () { 
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) { 
      form.addEventListener('submit', function (event) { 
        if (!form.checkValidity()) { 
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

const delModer = (id, username)=>{
    const answ = prompt("Вы действительно хотите удалить этого модератора? Для подтверждения введите его логин:")
    const data = {
        ID: id,
        delete: true
    }
    if(answ === username){
        $.post("/admin/moderationEdit", data, (e)=>{
            window.location.href = "/admin/settings?delete";
        } )
    }
}
</script>