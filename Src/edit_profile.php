<?php
session_start();

	// Connect to the database
require 'config.php';

	// Check if the user is logged in
if (!isset($_SESSION['username']))
	{
    // Redirect the user to the login page
    header('Location: login.php');
    exit();
}

	// Retrieve user profile from the database based on the authenticated username
	$authenticatedUsername = $_SESSION['username']; 
	$query = "SELECT * FROM users WHERE username = '$authenticatedUsername'";
	$result = $conn->query($query);
	
	// Check if the user profile was found
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Handle form submission to update the user information
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
        // Check if the delete account button is clicked
        if (isset($_POST['delete'])) {
			
            // Delete the user account from the database
            $deleteQuery = "DELETE FROM users WHERE username = '$authenticatedUsername'";
            $conn->query($deleteQuery);

            // Redirect to the home page after deleting the account
            header('Location: Home.html');
            exit();
        } else {
			
            // Retrieve the submitted form data
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $dob = $_POST['dob'];
            $nationality = $_POST['nationality'];
            $gender = $_POST['gender'];

            // Update the user information in the database
            $query = "UPDATE users SET name = '$name', username = '$username', password = '$password', email = '$email', phone = '$phone', address = '$address', dob = '$dob', nationality = '$nationality', gender = '$gender' WHERE username = '$authenticatedUsername'";
            $conn->query($query);

            // Redirect to the home page after updating the information
            header('Location: Home.html');
            exit();
        }
    }
} else {
    echo "No user found";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile Edit</title>
    <link rel="stylesheet" type="text/css" href="CSS/edit_profile.css">
    
</head>
<body>
    <div class="container">
        <h1>User Profile Edit</h1>

        <form method="POST">
            <div class="form-group">
                <label class="label">Name</label>
                <input type="text" class="form-input" name="name" value="<?php echo $user['name']; ?>" required>
            </div>

            <div class="form-group">
                <label class="label">Username</label>
                <input type="text" class="form-input" name="username" value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="form-group">
                <label class="label">Password</label>
                <input type="password" class="form-input" name="password" value="<?php echo $user['password']; ?>" required>
            </div>

            <div class="form-group">
                <label class="label">Email Address</label>
                <input type="email" class="form-input" name="email" value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="form-group">
                <label class="label">Phone Number</label>
                <input type="text" class="form-input" name="phone" value="<?php echo $user['phone']; ?>" required>
            </div>

            <div class="form-group">
                <label class="label">Address</label>
                <input type="text" class="form-input" name="address" value="<?php echo $user['address']; ?>" required>
            </div>

            <div class="form-group">
                <label class="label">Date of Birth</label>
                <input type="date" class="form-input" name="dob" value="<?php echo $user['dob']; ?>" required>
            </div>

            <div class="form-group">
                <label class="label">Nationality</label>
                <input type="text" class="form-input" name="nationality" value="<?php echo $user['nationality']; ?>" required>
            </div>

            <div class="form-group">
                <label class="label">Gender</label>
                <label><input type="radio" name="gender" value="Male" <?php if ($user['gender'] === 'Male') echo 'checked'; ?>> Male</label>
                <label><input type="radio" name="gender" value="Female" <?php if ($user['gender'] === 'Female') echo 'checked'; ?>> Female</label>
            </div>

            <div class="form-group">
                <input type="submit" class="form-input" value="Update">
                <input type="submit" class="delete-button" name="delete" value="Delete Account">
            </div>
        </form>
    </div>
</body>
</html>
