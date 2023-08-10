<?php

session_start();

// Database configuration
$host = 'hdc353.encs.concordia.ca';
$user = 'hdc353_1';
$password = '353says4';
$database = 'hdc353_1'; 

// PDO database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>