<?php
$hostname = 'localhost';
$username = 'root';
$password = 'root';

$dbh = new PDO("mysql:host=$hostname;dbname=slither", $username, $password);

session_start();
?>