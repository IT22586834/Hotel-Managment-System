<?php

session_start();

require 'config.php';
	
if (!isset($_SESSION['username']))
	{
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $roomID = $_POST['room_id'];
    $roomType = $_POST['room_type'];
    $price = $_POST['price'];
    $hotelID = $_POST['hotel_id'];
    

    if (isset($_FILES['roomImage']) && $_FILES['roomImage']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['roomImage']['tmp_name'];
        $imageName = $_FILES['roomImage']['name'];
        
     
        $filepath = 'Image/Room/' . $imageName;
        move_uploaded_file($image, $filepath);
        
      
        $sql = "UPDATE room SET room_type = '$roomType', price = '$price', hotel_ID = '$hotelID', image = '$filepath' WHERE room_ID = '$roomID'";
    } else {
       
        $sql = "UPDATE room SET room_type = '$roomType', price = '$price', hotel_ID = '$hotelID' WHERE room_ID = '$roomID'";
    }
    
   
    if ($conn->query($sql) === TRUE) {
        echo "Room details updated successfully.";
    } else {
        echo "Error updating room details: " . $conn->error;
    }
}

$conn->close();
?>
