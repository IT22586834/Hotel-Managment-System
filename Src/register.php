
<?php

	// Connect to the database
    require 'config.php';
	
	// Retrieve user input from the registration form
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$dob = $_POST['dob'];
	$nationality = $_POST['nationality'];
	$gender = $_POST['gender'];

	// Check if the username already exists in the database
	$checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
	$result = $conn->query($checkUsernameQuery);

if ($result->num_rows == 0) {
    // Username does not exist, so insert the user's data into the users table
	
    $sql = "INSERT INTO users (name, username, password, email, phone, address, dob, nationality, gender)
            VALUES ('$name', '$username', '$password', '$email', '$phone', '$address', '$dob', '$nationality', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
		
        // Redirect to the login page
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Username already exists. Please choose a different username.";
}



$conn->close();
?>
