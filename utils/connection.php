<?php
try {
    $hostname = "info.tm.edu.ro:3366";
    $username = "nbodrogean";
    $password = "N@dir@%B0lT";
    $database = "nbodrogean";

    // Connection to the database 
    $database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8mb4", $username, $password);

    // enable the database to throw  errors (e.g. throw a "23000" error when duplicate data is inserted in unique fields);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<h1>Error : " . $e->getMessage() . "<h1/>";
    die();
}
?>