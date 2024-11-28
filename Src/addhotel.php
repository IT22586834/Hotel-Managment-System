<?php

session_start();

	
require 'config.php';

	
if (!isset($_SESSION['username']))
	{
    
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $hotelName = $_POST['hotelName'];
    $emailAddress = $_POST['emailAddress'];
    $address = $_POST['address'];


    $imagePath = "Image/Hotel/" . $_FILES['image']['name'];


    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
      
        $sql = "INSERT INTO hotel (name, email_address, address, image1)
        VALUES ('$hotelName', '$emailAddress', '$address', '$imagePath')";

        if ($conn->query($sql) === TRUE) {
            echo "Successful";
        } else {
            echo "Error adding hotel: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
