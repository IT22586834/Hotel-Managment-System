<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
    <link rel="stylesheet" href="CSS/style.css">
    <script src="JS/Javascript.js"></script>
</head>
<body>
    <h1>Payment Confirmation</h1>

    <?php
require 'config.php';

$reservationId = $_POST['reservation_id'];
$cardNumber = $_POST['card_number'];
$expiryMonth = $_POST['expiry_month'];
$expiryYear = $_POST['expiry_year'];
$cvv = $_POST['cvv'];
$paymentReference = $_POST['payment_reference'];

// Perform payment processing and other necessary actions here

// Display payment confirmation
echo "Payment has been confirmed.<br><br>";
echo "Reservation ID: " . $reservationId . "<br>";
echo "Payment Reference: " . $paymentReference;

$conn->close();
?>

</body>
</html>
