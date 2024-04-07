<?php

session_start();

// Database configuration
$host = '';
$user = '';
$password = '';
$database = ''; 

// PDO database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
