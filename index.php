<?php 
	
include('db/connection.php');
 ?>


 <!DOCTYPE html>
 <html>
 <?php include('style.php'); ?>
 <?php include('header.php'); ?>

 	<section class= "container" grey-text>
 		<div>
 				<h4 class="center"> <b>LOGIN</b></h4>
 			<form class="white" action="login.php" method="POST" >
 				<label> User Name:</label>
 				<input type="text" name="username" placeholder="John Doe">
 				<label>Password:</label>
 				<input type="password" name="password" placeholder="*****">
 				<div class="center">
 				<input type="submit" name="submit" action="submit" class="btn">

 				</div>
 				<div class="center" id="reg">
 					</br>Don't have an Account? <a href="register.php"> <b> Register Now! </b> </a>
 					</script>
 				</div>
 			</form>
 		</div>
 </section>


 
 <?php include('footer.php'); ?>
 </body>
 </html>