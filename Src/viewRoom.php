<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <script src="JS/Javascript.js"></script>
</head>
<body>
    <header>
        <a href="admin.html">
            <img src="Image/Logo.png" class="mlogo" alt="Logo">
        </a>
        <img src="Image/Profile.png" class="prologo">
    </header>
    <br>

    <?php
    require 'config.php';
    $hotelName = $_GET['hotel_name1'];
    ?>

    <center>
        <form action="addroom.php" method="get">
            <input type="hidden" name="hotel_name1" value="<?php echo $hotelName; ?>">
            <input type="submit" value="Add Room" class="button3">
        </form>
    </center>

    <?php
    $sql = "SELECT r.image, h.name, r.room_type, room_ID, price 
            FROM room r, hotel h 
            WHERE r.hotel_ID = h.hotel_ID and h.name='$hotelName'";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $roomImage = $row['image'];
        $hotelName = $row['name'];
        $roomType = $row['room_type'];
        $roomID = $row['room_ID'];
        $price = $row['price'];

        echo "<br>Hotel Name: $hotelName<br>";
        echo "Room Type: $roomType<br>";
        echo "Price: $price USD <br> ";
        echo "<img src= '$roomImage' alt='Hotel Image' class='hotel1i'><br>";
        ?>

        <form action='editRoom.php' method='get' class='select'>
            <input type='hidden' name='room_id' value='<?php echo $roomID; ?>'>
            <input type='hidden' name='hotel_name1' value='<?php echo $hotelName; ?>'>
            <button type='submit'>Edit</button>
        </form>

        <form action='deleteRoom.php' method='get' class='select'>
            <input type='hidden' name='room_id' value='<?php echo $roomID; ?>'>
            <input type='hidden' name='hotel_name1' value='<?php echo $hotelName; ?>'>
            <button type="submit" onclick="return confirmDelete()">Delete</button>
        </form>

    <?php
    }
    $conn->close();
    ?>

    <hr>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h4>Support & FAQS</h4>
                <ul>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="contact us.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Policies</h4>
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Other Information</h4>
                <ul>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="About us.html">About Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <img src="Image/Social.png" class="social" alt="Social" align="center" width="250px" 250px height="30px">
        </div>
        <br>
        <center>
            <div class="footer-text"><br>2023 Hanami. All Rights Reserved</div>
        </center>
    </footer>
</body>
</html>
