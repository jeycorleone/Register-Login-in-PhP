<?php 
include ('db/connection.php');
 
 // Check if the form is submitted
if (isset($_POST['submit'])) {
    

    // Get user input from the form
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Validate input
    if (empty($user) || empty($pass)) {
        echo "Username and password are required!";
    } else {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);

        // Execute the statement
        $stmt->execute();

        // Store the result so we can check if the user exists
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($hashed_pass);
            $stmt->fetch();

            // Verify the password
            if (password_verify($pass, $hashed_pass)) {
                // Start the session and set session variables
                session_start();
                $_SESSION['username'] = $user;
                echo "Login successful! Welcome, " . $_SESSION['username'];
                echo '<script>
        		window.location.href="register.php";
        		alert("Login Successful!")
        		</script>' . $_SESSION['username'];
                // Redirect to another page, e.g., dashboard.php
                header("Location: welcome.php");
                exit();
            } else {
                echo '<script>
        		window.location.href="login.php";
        		alert("Invalid password!")
        		</script>';

        		header("Location: index.php");
            }
        } else {
            
            echo '<script>
        		window.location.href="register.php";
        		alert("No user found with that username!")
        		</script>';
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}

 ?>