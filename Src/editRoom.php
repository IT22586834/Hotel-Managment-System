<!DOCTYPE html>
<html>
<head>
    <title>Update Room</title>
    <link rel="stylesheet" href="CSS/style5.css">
</head>
<body>
<center><h2>Update Room</h2></center>
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $room_id1 = $_GET['room_id'];

    // echo 'Room ID ='.$room_id1;

    
    $sql = "SELECT * FROM room WHERE room_ID = '$room_id1'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    ?>
    <div class="container">
    <form action="updateRoom.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="room_id" value="<?php echo $row["room_ID"] ?>">
              <label for="roomType">Room Type:</label>
              <input type="text" name="room_type" id="roomType" value="<?php echo $row["room_type"]  ?>" required>
              <br><br>
              <label for="price">Price:</label>
              <input type="number" name="price" id="price" value="<?php echo $row["price"]  ?>" required>
              
              
              <input type="hidden" name="hotel_id" id="hotelID" value="<?php echo $row["hotel_ID"]?>" required>
              <br><br>
              <label for="roomImage">New Room Image:</label>
              <input type="file" name="roomImage" id="roomImage">
              <br><br>
              <input type="submit" value="Update">
          </form>
    </Div>
          <?php
}
$conn->close();
?>
</body>
</html>

