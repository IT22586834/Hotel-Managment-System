<?php
// Establish connection to MySQL database
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "hanami";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$authenticatedUsername = $_SESSION['username']; // Use the authenticated username from the session
$query = "SELECT * FROM users WHERE username = '$authenticatedUsername'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found";
}


// Check if form is submitted
if (isset($_POST['submit'])) {
    // Generate Reservation ID
    $reservationId = uniqid();

    // Get the form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];
    $totalAmount = $_POST['total'];
    $hotel_name = $_GET['hotel_name'];
    $room_id = $_GET['room'];
    $check_in = $_GET['checkin'];
    $check_out = $_GET['checkout'];

    // Check if the reservation ID exists in the reservation table
    $reservationCheckQuery = "SELECT * FROM reservation WHERE reservation_id='$reservationId'";
    $reservationCheckResult = $conn->query($reservationCheckQuery);

    if ($reservationCheckResult->num_rows > 0) {
        // If the reservation ID already exists, regenerate a new one
        $reservationId = uniqid();
    }

    // Insert the payment details into the payment table
    $paymentSql = "INSERT INTO payment (reservation_id, total, first_name, last_name, card_number, expiry_date, cvv, created_at)
               VALUES ('$reservationId', '$totalAmount', '$firstName', '$lastName', '$cardNumber', '$expiryDate', '$cvv', NOW())";



    if ($conn->query($paymentSql) === TRUE) {
        // Insert reservation details into the reservation table
        $reservationSql = "INSERT INTO reservation (reservation_id, username, hotel_name, room_type, check_in, check_out) 
                           VALUES ('$reservationId', '$authenticatedUsername', '$hotel_name', NULL, '$check_in', '$check_out')";

        if ($conn->query($reservationSql) === TRUE) {
            echo "Payment successful! Your Reservation ID is: " . $reservationId;
            echo '<p>Redirecting to Reservation Page...</p>';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "view.php?reservation_id=' . $reservationId . '";
                    }, 3000);
                  </script>';
            exit;
        } else {
            echo "Error: " . $reservationSql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $paymentSql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <style>
        /* CSS styles here */
    </style>
</head>
<body>
<?php
// Retrieve the total amount from the room table
$room = $_GET['room'];
$query = "SELECT price FROM room WHERE room_ID='$room'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalAmount = $row['price'];
} else {
    echo "Error: Total amount not found for the selected room";
    exit();
}
?>

<h1>Payment Page</h1>

<form method="post" action="payment.php?room=<?php echo $room; ?>&hotel_name=<?php echo urlencode($_GET['hotel_name']); ?>&checkin=<?php echo urlencode($_GET['checkin']); ?>&checkout=<?php echo urlencode($_GET['checkout']); ?>">
    <label for="total">Total:</label>
    <input type="text" id="total" name="total" value="<?php echo $totalAmount; ?>" readonly><br><br>

    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required><br><br>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required><br><br>

    <label for="cardNumber">Card Number:</label>
    <input type="text" id="cardNumber" name="cardNumber" required><br><br>

    <label for="expiryDate">Expiry Date:</label>
    <input type="text" id="expiryDate" name="expiryDate" required><br><br>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required><br><br>

    <input type="submit" value="Submit" name="submit">
</form>
</body>
</html>

