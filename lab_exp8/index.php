<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            header("Location: home.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<script src="auth.js"></script>
</head>
<body>
<body>
<div style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%);">
    <a href="../index.html" style="padding: 8px 14px; background: #0077ff; color: white; text-decoration: none; border-radius: 5px; cursor: pointer;">Back to Home</a>
</div>

<div class="container">
<h2>Login</h2>

<form name="login" method="POST" onsubmit="return validateLogin()">
  <input type="email" name="email" placeholder="Email">
  <input type="password" name="password" placeholder="Password">
  <button type="submit">Login</button>
</form>

<p>New user? <a href="signup.php">Signup</a></p>
</div>

</body>
</html>