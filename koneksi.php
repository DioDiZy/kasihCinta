<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "kasihcinta";

if (!$con = mysqli_connect($host, $user, $pass, $db)) {


    die("failed to connect!");
}
