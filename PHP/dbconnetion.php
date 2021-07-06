<?php
require_once "./env.php";
$mysqli = new mysqli($host, $username, $password, $dbname);
$mysqli->set_charset("utf8");