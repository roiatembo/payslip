<?php
$host = 'localhost';        // Database host
$dbName = 'dithetoc_payslip';  // Database name
$username = 'dithetoc_roia'; // Database username
$password = 'rolanga4'; // Database password

// Establish the database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Failed to connect to the database: " . $e->getMessage());
}
?>
