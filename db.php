<?php
// Database connection details
$servername = "localhost"; // Usually localhost for local development
$username = "root"; // Your MySQL username, default is "root"
$password = ""; // Your MySQL password, default is an empty string
$dbname = "ebook_store"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
