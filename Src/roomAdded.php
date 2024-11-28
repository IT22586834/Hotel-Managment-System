<?php
session_start();

	
require 'config.php';

	
if (!isset($_SESSION['username']))
	{
    
    header('Location: login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $hotelID = $_POST['hotel_id'];
    $roomType = $_POST['room_type'];
    $price = $_POST['price'];

    
    $imagePath = "Image/Room/" . $_FILES['roomImage']['name'];

   
    if (move_uploaded_file($_FILES['roomImage']['tmp_name'], $imagePath)) {
       
        $sql = "INSERT INTO room (room_type, price, hotel_ID, image)
        VALUES ('$roomType', '$price', '$hotelID', '$imagePath')";

        if ($conn->query($sql) === TRUE) {
            echo "Room added successfully";
            
        } else {
            echo "Error adding room: " . $conn->error;
        }
    } else {
        echo "Error!";
    }
}
?>
