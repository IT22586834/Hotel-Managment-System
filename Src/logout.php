<?php
// Connect to the database
    require 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Unset specific session variable(s)
unset($_SESSION['username']);

// Redirect to the home page
header('Location: home.html');
exit();
?>
