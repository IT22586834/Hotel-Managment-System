<?php
// Retrieve user input from the contact form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hanami";

// Create a new mysqli instance
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully!";
} else {
    echo "Oops! Something went wrong.";
}

// Close the database connection
$conn->close();
?>
