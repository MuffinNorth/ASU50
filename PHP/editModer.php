<?php
$count = 1;
function genModer($who, $email){
    global $count;
    echo "<tr>";
    echo "<th scope=\"row\">$count</th>";
    echo "<td>$who</td>";
    echo "<td>$email</td>";
    echo "<td>
    <button class=\"btn btn-warning\">
    Редактировать
    </button>
    <button class=\"btn btn-danger\">
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
    <div class="card mt-1">
    <h5 class="card-header">Добавить модератора</h5>
    <div class="card-body">
        <form class="row g-3 needs-validation" novalidate>
        <input type="hidden" class="form-control" id="ID">
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Логин</label>
                <input type="text" class="form-control" id="validationCustom01" required>
                <div class="valid-feedback">
                    Хорошо!
                </div>
                <div class="invalid-feedback">
                    Пожалуйста введите логин!
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Email</label>
                <input type="text" class="form-control" id="validationCustom02" required>
                <div class="valid-feedback">
                    Хорошо!
                </div>
                <div class="invalid-feedback">
                    Пожалуйста введите почту!
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="validationCustom03" required>
                <div class="valid-feedback">
                    Хорошо!
                </div>
                <div class="invalid-feedback">
                    Пожалуйста введите пароль!
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Создать/обновить</button>
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
            <th scope="col">Функции</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for($i = 0; $i < $result->num_rows; $i++){
                $r = $result->fetch_assoc();
                genModer($r['login'], $r['email']);
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
</script>