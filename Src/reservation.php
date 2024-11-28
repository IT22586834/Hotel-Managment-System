<!DOCTYPE html>
<html>
<head>
    <title>Reservation Confirmation</title>
	
    <link rel="stylesheet" href="reservation.css">
	
    <script src="JS/Javascript.js"></script>
</head>
<body>
    <h1>Reservation Confirmation</h1>

    <?php
    
    session_start();

    if (!isset($_SESSION['username'])) {
   
        header('Location: login.php');
        exit();
    }

    require 'config.php';
    
    $authenticatedUsername = $_SESSION['username']; 
    $query = "SELECT * FROM users WHERE username = '$authenticatedUsername'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "No user found";
    }
    

    $hotelName = $_GET['hotel_name'];
    $roomType = $_GET['room'];
    $checkInDate = $_GET['checkin'];
    $checkOutDate = $_GET['checkout'];
    $user = $user['username'];
    $sql = "INSERT INTO reservation (username, hotel_name, room_type, check_in, check_out) VALUES ('$user', '$hotelName', '$roomType', '$checkInDate', '$checkOutDate')";

    if ($conn->query($sql) === TRUE) {
        $reservationId = $conn->insert_id;

        echo "<p>Your reservation has been confirmed.</p>";
        echo "<p>Reservation ID: " . $reservationId . "</p>";
        echo "<p>Hotel: " . $hotelName . "</p>";
        echo "<p>Room Type: " . $roomType . "</p>";
        echo "<p>Check-in: " . $checkInDate . "</p>";
        echo "<p>Check-out: " . $checkOutDate . "</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>


<h1>Payment Confirmation</h1>

    <h3><b>Please provide payment confirmation details:</b></h3>
    <form action="makepayment.php" method="post">
        <input type="hidden" name="reservation_id" value="<?php echo $reservationId; ?>">
        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" required>
        <br>
        <label for="expiry_month">Expiry Month:</label>
        <input type="text" id="expiry_month" name="expiry_month" required>
        <br>
        <label for="expiry_year">Expiry Year:</label>
        <input type="text" id="expiry_year" name="expiry_year" required>
        <br>
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required>
        <br>
        <label for="payment_reference">Payment Reference:</label>
        <input type="text" id="payment_reference" name="payment_reference" required>
        <input type="submit" value="Confirm Payment">
    </form>
</body>
</html>
