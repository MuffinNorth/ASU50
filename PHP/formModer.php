<?php
$count = 1;
function genLogs($who, $when, $what){
    global $count;
    echo "<tr>";
    echo "<th scope=\"row\">$count</th>";
    echo "<td>$who</td>";
    echo "<td>$when</td>";
    echo "<td>$what</td>";
    echo "</tr>";
    $count++;
}
require_once "./PHP/controllers/log_controller.php";
$sql = "SELECT admins.login, logs.when, logs.what FROM `logs`, `admins` WHERE admins.id = logs.who ORDER BY `logs`.`when` DESC";
$result = $mysqli->query($sql);
?>
<button class="btn btn-danger">Очистить логи</button>
<table class="table table-striped table-bordered table-hover table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Логин</th>
      <th scope="col">Когда</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i = 0; $i < $result->num_rows; $i++){
            $r = $result->fetch_assoc();
            genLogs($r['login'], $r['when'], $r['what']);
        }
    ?>
  </tbody>
</table>
