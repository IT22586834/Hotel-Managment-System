<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <script src="JS/Javascript.js"></script>
</head>

<header>
    <a href="Home.html">
        <img src="Image/Logo.png" class="mlogo" alt="Logo">
    </a>
    <img src="Image/Profile.png" class="prologo">

    <div class="buttonset">
        <select name="language" class="language">
            <option value="English">English</option>
            <option value="Russia">Русский</option>
            <option value="Spanish">Español</option>
            <option value="Japanese">日本語</option>
        </select>

        <a href="Contact Us.html">
            <button class="button2">
                Contact Us
            </button>
        </a>

        <a href="About Us.html">
            <button class="button1">
                About us
            </button>
        </a>
    </div>
</header>

<br>

<div class="des">
    <form action="hotelResult.php" method="get" class="searchform">
        <label for="hotelserach">
            <img src="Image/hotel.png" class="hotellogo">
        </label>
        <input type="text" name="hotel_name" class="hotelserach" Placeholder="Look your Desired Destination Here" required>
        <label for="check-in"> Check-In </label>
        <input type="date" id="check-in" name="check-in" min="date" required>
        <label for="check-out1"> Check-Out </label>
        <input type="date" id="check-out1" name="check-out" required>
        <button type="submit" id="demo"><img src="Image/search.png" class="search"></button>
    </form>
</div>

<body>
    <br>
    <div>
        Results:
    </div>
    <br>
    <div class="results">
        <?php
        require 'config.php';

        $hotelName = $_GET['hotel_name'];
        $checkInDate = $_GET['check-in'];
        $checkOutDate = $_GET['check-out'];
        $currentDate = date("Y-m-d");

        $in = 0;
        $out = 0;

        if ($checkInDate < $currentDate) {
            echo "<br>Please select a valid check-in date.";
            $in = 1;
        }

        if ($checkOutDate <= $checkInDate) {
            echo "<br>Please select a valid check-out date.";
            $out = 1;
        }

        if ($in == 0 && $out == 0) {
            $sql = "SELECT name, image1 FROM hotel WHERE name LIKE '%$hotelName%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<br>Hotel Name: " . $row["name"] . "<br>";
                    $images = $row["image1"];
        ?>
                    <img src="<?php echo $images ?>" alt='Hotel Image' class="hotel1i">

                    <form action="roomResult.php" method="get" class="select">
                        <input type="hidden" name="hotel_name1" value="<?php echo $row["name"]; ?>">
                        <input type="hidden" name="checkin" value="<?php echo $checkInDate; ?>">
                        <input type="hidden" name="checkout" value="<?php echo $checkOutDate; ?>">
                        <button type="submit">Select</button>
                    </form>
        <?php
                }
            } else {
                echo "<br><h3>No hotels found!</h3>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>

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
        <center><div class="footer-text"><br>2023 Hanami. All Rights Reserved</div></center>
    </footer>

</html>
