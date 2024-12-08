<?php

session_start();

if (isset($_SESSION['id_donatur'])) {
	session_destroy();
}

header("Location: login.php");
die;
