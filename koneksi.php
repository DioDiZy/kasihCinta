<?php
$host = "btd2ishhks9bqlvbicyt-mysql.services.clever-cloud.com";
$user = "uzx5rpy9fd8ngm0d";
$pass = "FXd0uin6iaOl6WgAehaq";
$db = "btd2ishhks9bqlvbicyt";

if (!$con = mysqli_connect($host, $user, $pass, $db)) {


    die("failed to connect!");
}
