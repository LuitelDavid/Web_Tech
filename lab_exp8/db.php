<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "auth_demo";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- CREATE A DATABASE BEFORE LAUNCHING -->
<!-- 

CREATE DATABASE auth_demo;

USE auth_demo;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
); 

-->