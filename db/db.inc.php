<?php
//to connect to the database

$dsn = "mysql:host=localhost;dbname=hmdt";
$dbusername = "root";
$dbpassword = "";
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword, $option);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}