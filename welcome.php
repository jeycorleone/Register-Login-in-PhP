<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<?php include('header.php'); ?>
<body>
<h5> LogIn Succesful </h5>

<br>
<br>
<br>


<div class="center">
    <form action="welcome.php" method="POST">
        <input type="submit" name="logout" value="Logout" class="btn2">
    </form>
</div>


<?php 
	// Start the session
session_start();

// Check if the logout button was clicked
if (isset($_POST['logout'])) {
    // Destroy the session
    session_unset();   // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to login page or another appropriate page
    header("Location: index.php");
    exit();
}

 ?>

</body>
</html>