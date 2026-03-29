<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <h2>Welcome</h2>
  <p>Hello, <strong><?php echo $_SESSION['name']; ?></strong></p>

  <form method="POST" action="logout.php">
    <button>Logout</button>
  </form>
</div>

</body>
</html>