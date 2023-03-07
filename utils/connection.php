<?php
$hostname = "info.tm.edu.ro:3366";
$username = "nbodrogean";
$password = "N@dir@%B0lT";
$database = "nbodrogean";

// Connection to the database 
$database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8mb4", $username, $password);
?>