<?php
$servername = "localhost";
$username = "root";  // changez ceci en fonction de votre configuration
$password = "";      // changez ceci en fonction de votre configuration
$dbname = "digitf";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
