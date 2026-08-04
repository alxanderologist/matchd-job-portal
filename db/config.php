<?php

$host = 'localhost';
$user = 'root';
$pass = 'password';
$db = 'matchddb';
$port = 3307;

$connection = new mysqli($host, $user, $pass, $db, $port);

if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

?>
