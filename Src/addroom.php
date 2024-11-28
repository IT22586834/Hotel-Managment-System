<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
    <link rel="stylesheet" href="CSS/style3.css">
    
    <script src="JS/Javascript.js"></script>
</head>
<body>
    <h2>Add Room</h2>    

    <?php
 
    require 'config.php';

    $hotelName = $_GET['hotel_name1'];


    $query = "SELECT hotel_ID FROM hotel WHERE name = '$hotelName'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $id = $row['hotel_ID'];


    
    ?>
    <div class="container">
    <form action="roomAdded.php" method="post" enctype="multipart/form-data">
  
        <input type="hidden" name="hotel_id" value="<?php echo $row['hotel_ID']; ?>">

        <label for="roomType">Room Type:</label>
        <input type="text" name="room_type" id="roomType" required>
        <br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required>
        <br><br>

        <label for="roomImage">Room Image:</label>
        <input type="file" name="roomImage" id="roomImage" required>
        <br><br>

        <input type="submit" value="Add Room"></button>
    </form>
</div>

</body>
</html>
