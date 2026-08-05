<?php

$host = 'localhost';
$user = 'root';
$pass = 'ARAYKO';
$db = 'matchddb';
$port = 3306;

$connection = new mysqli($host, $user, $pass, $db, $port);

if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

?>