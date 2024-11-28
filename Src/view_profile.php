<?php
session_start();

if (!isset($_SESSION['username'])) {
   
    header('Location: login.php');
    exit();
}


require'config.php';


$authenticatedUsername = $_SESSION['username']; 
$query = "SELECT * FROM users WHERE username = '$authenticatedUsername'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found";
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="CSS/view_profile.css">
    
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>

        <div class="form-group">
            <label class="label">Name</label>
            <input type="text" class="form-input" value="<?php echo $user['name']; ?>" readonly>
        </div>

        <div class="form-group">
            <label class="label">Username</label>
            <input type="text" class="form-input" value="<?php echo $user['username']; ?>" readonly>
        </div>

        <div class="form-group">
            <label class="label">Password</label>
            <input type="password" class="form-input" value="<?php echo $user['password']; ?>" readonly>
        </div>

        <div class="form-group">
            <label class="label">Email Address</label>
            <input type="email" class="form-input" value="<?php echo $user['email']; ?>" readonly>
        </div>

        <div class="form-group">
            <label class="label">Phone Number</label>
            <input type="text" class="form-input" value="<?php echo $user['phone']; ?>" readonly>
        </div>

        <div class="form-group">
            <label class="label">Address</label>
            <input type="text" class="form-input" value="<?php echo $user['address']; ?>" readonly>
        </div>

        <div class="form-group">
            <label class="label">Date of Birth</label>
            <input type="date" class="form-input" value="<?php echo $user['dob']; ?>" readonly>
        </div>

        <div class="form-group">
            <label class="label">Nationality</label>
            <input type="text" class="form-input" value="<?php echo $user['nationality']; ?>" readonly>
        </div>

        <div class="form-group">
            <label class="label">Gender</label>
            <input type="text" class="form-input" value="<?php echo $user['gender']; ?>" readonly>
        </div>

        <div class="form-group">
            <a href="edit_profile.php" class="edit-button">Edit Profile</a>
        </div>
        <div class="form-group">
            <a href="logout.php" class="edit-button">Log Out</a>
        </div>
    </div>
</body>
</html>
