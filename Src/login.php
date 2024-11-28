<?php
// Start a session
session_start();

	// Initialize error message variable
$errorMsg = '';


    // Connect to the database
    require 'config.php';
	
	// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    // Retrieve user input from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $accountType = $_POST['accountType']; 
	
	//check account type
    if ($accountType == "user") {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
        $result = mysqli_query($conn, $sql);
        $check = mysqli_fetch_array($result);
		
        if(isset($check)){
            // Successful login
            $_SESSION['username'] = $username; // Store username in session variable
            header('Location: Home.html'); // Redirect to the index page
            exit();
			
        } else {
            // Failed login
            $errorMsg = 'Invalid username or password';
        }
    } elseif ($accountType == "admin") {
        $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' ";
        $result = mysqli_query($conn, $sql);
        $check = mysqli_fetch_array($result);
		
        if(isset($check)){
            // Successful login
            $_SESSION['username'] = $username; // Store username in session variable
            header('Location: admin.html'); // Redirect to the admin page
            exit();
			
        } else {
            // Failed login
            $errorMsg = 'Invalid username or password';
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/loginStyle.css">

</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="accountType">Account Type:</label>
            <select id="accountType" name="accountType" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            
            <button type="submit">Submit</button>
            
            <?php if ($errorMsg != ''): ?>
			<!-- Display error msg -->
                <p class="error-msg"><?php echo $errorMsg; ?></p> 
            <?php endif; ?>
        </form>
        <p>Don't have an account? <a href="register.html">Register</a></p>
    </div>
</body>
</html>


