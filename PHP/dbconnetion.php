<?php
$host = "localhost";
$username = "asuadmin";
$password = "password";
$dbname = "asudb_new";
$mysqli = new mysqli($host, $username, $password, $dbname);
$mysqli->set_charset("utf8");