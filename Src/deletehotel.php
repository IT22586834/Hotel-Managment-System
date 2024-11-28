<?php

session_start();

	
if (!isset($_SESSION['username']))
	{
    
    header('Location: login.php');
    exit();
}

require 'config.php';

$hotelName = $_GET["hotel_name1"];	


$sqlDeleteRooms = "DELETE FROM room WHERE hotel_ID IN (SELECT hotel_ID FROM hotel WHERE name = '$hotelName')";

if ($conn->query($sqlDeleteRooms) === TRUE) {
    echo "Rooms deleted successfully. <br>";

   
    $sqlDeleteHotel = "DELETE FROM hotel WHERE name = '$hotelName'";

    if ($conn->query($sqlDeleteHotel) === TRUE) {
        echo "successfull";
    } else {
        echo "Error deleting hotel: " . $conn->error;
    }
} else {
    echo "Error deleting rooms: " . $conn->error;
}


$conn->close();
?>
