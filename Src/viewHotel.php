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
<body>
<br>
<?php

require'config.php';


$sql = "SELECT h.name,h.image1
        FROM hotel h";
$result = $conn->query($sql);


while ($row = $result->fetch_assoc()) {
  $hotelImage = $row['image1'];
  $hotelName = $row['name'];
  

  echo "<br>Hotel Name: $hotelName<br>";
  
?>

  
  <img src= "<?php echo $hotelImage ?>" alt='Hotel Image' class="hotel1i" >
  <br>
    <form action="viewRoom.php" method="get" class="select">
        <input type="hidden" name="hotel_name1" value="<?php echo $row["name"]; ?>">
            <button type="submit">View Room</button>
    </form>
    <form action="deletehotel.php" method="get" class="select">
        <input type="hidden" name="hotel_name1" value="<?php echo $row["name"]; ?>">
        <button type="submit" onclick="return confirmDelete()">Delete Hotel</button>
    </form>

    <form action="editHotel.php" method="get" class="select">
    <input type="hidden" name="hotel_name1" value="<?php echo $row["name"]; ?>">
    <button type="submit">Edit</button>
    </form>

    
<?php
}

$conn->close();
?>



    <hr>

</body>
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
        <center><div class="footer-text"><br>2023 Hanami. All Rights Reserved</div></center>
    </footer>

</body>
</html>
