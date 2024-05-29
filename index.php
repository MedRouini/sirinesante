<?php
session_start();

error_reporting(E_ALL);

set_time_limit(1500);
ini_set("mysql.connect_timeout", "1500");
ini_set("default_socket_timeout", "300");
$MESSAGE = "";

// Chargement du fichier de configuration
require_once "./config.php";
header('Location: http://sante/HTML/login.html');