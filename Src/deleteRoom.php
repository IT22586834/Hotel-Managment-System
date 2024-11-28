<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $roomID = $_GET['room_id'];

    $sql = "DELETE FROM room WHERE room_ID = '$roomID'";

    if ($conn->query($sql) === TRUE) {
        echo "successfull";
    } else {
        echo "Error deleting room: " . $conn->error;
    }

    $conn->close();
}
?>
