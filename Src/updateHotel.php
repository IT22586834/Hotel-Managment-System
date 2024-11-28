<?php

session_start();

require 'config.php';

if (!isset($_SESSION['username']))
	{
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $hotelID = $_POST['hotel_ID'];
    $hotelName = $_POST['hotelName'];
    $emailAddress = $_POST['emailAddress'];
    $hotelAddress = $_POST['hotelAddress'];

    if (isset($_FILES['hotelImage']) && $_FILES['hotelImage']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['hotelImage']['tmp_name'];
        $imageName = $_FILES['hotelImage']['name'];

       
        $destination = 'Image/Hotel/' . $imageName;
        move_uploaded_file($image, $destination);

       
        $sql = "UPDATE hotel SET name = '$hotelName', email_address = '$emailAddress', address = '$hotelAddress', image1 = '$destination' WHERE hotel_ID = '$hotelID'";
    } else {
        
        $sql = "UPDATE hotel SET name = '$hotelName', email_address = '$emailAddress', address = '$hotelAddress' WHERE hotel_ID = '$hotelID'";
    }

    $result = $conn->query($sql);

    if ($result) {
        echo "Hotel details updated successfully.";
    } else {
        echo "Error updating hotel details: " . $conn->error;
    }
}
?>
