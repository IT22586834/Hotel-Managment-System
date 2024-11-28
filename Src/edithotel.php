<!DOCTYPE html>
<html>
<head>
    <title>Update Hotel</title>
    <link rel="stylesheet" href="CSS/style5.css">
</head>
<body>
    <center><h2>Update Hotel</h2></center>
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $hotelName1 = $_GET['hotel_name1'];

    $sql = "SELECT * FROM hotel WHERE name = '$hotelName1'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <div class="container">
    <form action="updateHotel.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="hotel_ID" value="<?php echo $row["hotel_ID"]; ?>">
        <label for="hotelName">Hotel Name:</label>
        <input type="text" name="hotelName" id="hotelName" value="<?php echo $row["name"]; ?>" required>
        <br><br>
        <label for="emailAddress">Email Address:</label>
        <input type="email" name="emailAddress" id="emailAddress" value="<?php echo $row["email_address"]; ?>" required>
        <br><br>
        <label for="hotelAddress">Address:</label>
        <input type="text" name="hotelAddress" id="hotelAddress" value="<?php echo $row["address"]; ?>" required>
        <br><br>
        <label for="hotelImage">New Hotel Image:</label>
        <input type="file" name="hotelImage" id="hotelImage">
        <br><br>
        <input type="submit" value="Update">
    </form>
</div>
<?php
}
$conn->close();
?>
</body>
</html>
