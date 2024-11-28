<?php
// Simulated payment processing
function processPayment($cardNumber, $cardHolder, $amount) {
    // Perform payment processing logic here
    // ...

    // Simulate successful payment
    $paymentSuccessful = true;

    return $paymentSuccessful;
}

// Check if the payment form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the payment details from the form
    $cardNumber = $_POST["cardNumber"];
    $cardHolder = $_POST["cardHolder"];
    $amount = $_POST["amount"];

    // Process the payment
    $paymentSuccessful = processPayment($cardNumber, $cardHolder, $amount);

    if ($paymentSuccessful) {
        // Payment successful
        echo "<h1>Payment Confirmation</h1>";
        echo "<p>Your payment of $" . $amount . " was successfully processed.</p>";
        echo "<p>Thank you for your purchase!</p>";
    } else {
        // Payment failed
        echo "<h1>Payment Confirmation</h1>";
        echo "<p>There was an error processing your payment.</p>";
        echo "<p>Please try again later or contact customer support.</p>";
    }
}
?>
