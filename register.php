<?php 
include ('db/connection.php');
 
 if(isset($_POST['submit'])) {

 	 // Get user input from the form
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpass'];

    // Validate input
    if(empty($user) || empty($email) || empty($pass) || empty($cpass)) {
        
          echo '<script>
        		window.location.href="register.php";
        		alert("All fields are required!")
        		</script>';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    
        echo '<script>
        		window.location.href="register.php";
        		alert("Invalid email format!")
        		</script>';
    } elseif($pass !== $cpass) {

        echo '<script>
        		window.location.href="register.php";
        		alert("Passwords do not match!")
        		</script>';

        } else {
        // Check if the username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Username already exists
        
            echo '<script>
                window.location.href="register.php";
                alert("This username is already taken!")
                </script>';

        } else {
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Email already exists
            
             echo '<script>
                window.location.href="register.php";
                alert("An account with this email already exists!")
                </script>';
        } else {
            // Email does not exist, proceed with registration
            $stmt->close();

        // Hash the password before storing
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $email, $hashed_pass);

        // Execute the statement
        if($stmt->execute()) {
            echo '<script>
        		window.location.href="register.php";
        		alert("Registration successful!")
        		</script>';
        		
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
	
 ?>

 <!DOCTYPE html>
 <html>
<?php include('header.php'); ?>
<?php include('style.php'); ?>
	
	<section class="container" grey-text>
		<div>
		<h4 class="center"> <b> Register Here </b></h4>
		<form class="white" action="register.php" method="POST">
			
			<input type="text" name="username" placeholder=" Enter username">
			
			<input type="email" name="email" placeholder="Enter Email">
			
			<input type="password" name="password" placeholder="Set password">
			
			<input type="password" name="cpass" placeholder="confirm password">
			
			<div class="center"><input type="submit" name="submit" action="submit" class="btn"> </div>

            <div class="center" id="loginbtn">
               <br>  Already have an Account?    <a href="index.php"> <b> Login Now! </b> </a>
                </div>
		</form>
	</div>
	</section>


<?php include('footer.php'); ?>
</body>
 </html>