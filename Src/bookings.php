<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page
    header('Location: login.php');
    exit();
}

// Database connection configuration
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "hanami";

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user profile from the database based on the authenticated username
$authenticatedUsername = $_SESSION['username']; // Use the authenticated username from the session
$query = "SELECT * FROM reservation WHERE username = '$authenticatedUsername'";
$result = $conn->query($query);

$reservations = array(); // Initialize an empty array to store reservations

if ($result->num_rows > 0) {
    // Loop through each row of the result and store reservations in the array
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

// Update check-in and check-out dates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservationId = $_POST['reservation_id'];
    $checkInDate = isset($_POST['checkin']) ? $_POST['checkin'] : '';
    $checkOutDate = isset($_POST['checkout']) ? $_POST['checkout'] : '';

    $updateSql = "UPDATE reservation SET check_in = '$checkInDate', check_out = '$checkOutDate' WHERE reservation_id = '$reservationId'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Check-in and check-out dates updated successfully.";
    } else {
        echo "Error updating check-in and check-out dates: " . $conn->error;
    }
}

// Delete reservation
if (isset($_POST['delete'])) {
    $reservationId = $_POST['reservation_id'];

    $deleteSql = "DELETE FROM reservation WHERE reservation_id = '$reservationId'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Reservation deleted successfully.";
        // Redirect the user to a confirmation page or any other desired action
        exit();
    } else {
        echo "Error deleting reservation: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .no-reservations {
            text-align: center;
            color: #999;
        }

        .edit-form input[type="text"] {
            width: 100px;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .edit-form input[type="submit"] {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            background-color: #337ab7;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .edit-form input[type="submit"]:hover {
            background-color: #23527c;
        }

        .delete-form {
            display: inline-block;
            margin-left: 10px;
        }

        .delete-form input[type="submit"] {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            background-color: #d9534f;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .delete-form input[type="submit"]:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <h1>Reservation</h1>

    <?php if (!empty($reservations)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Hotel Name</th>
                    <th>Room Type</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr>
                        <td><?php echo $reservation['reservation_id']; ?></td>
                        <td><?php echo $reservation['hotel_name']; ?></td>
                        <td><?php echo $reservation['room_type']; ?></td>
                        <td>
                            <form class="edit-form" action="" method="post">
                                <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                                <input type="text" name="checkin" value="<?php echo isset($reservation['check_in']) ? $reservation['check_in'] : ''; ?>">
                            </td>
                            <td>
                                <input type="text" name="checkout" value="<?php echo isset($reservation['check_out']) ? $reservation['check_out'] : ''; ?>">
                            </td>
                            <td>
                                <input type="submit" value="Update">
                            </form>
                            <form class="delete-form" action="" method="post">
                                <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="no-reservations">No reservations found.</p>
    <?php endif; ?>
</body>
</html>
