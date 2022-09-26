<?php

$conn = mysqli_connect('localhost','root','','tats') or die('connection failed');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>home</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header class ="header">
		<div class ="header-1">
			<div class = "flex">
				<div class = "share">
					<a href="#" class="fab fa-facebook-f"></a>
            		<a href="#" class="fab fa-twitter"></a>
            		<a href="#" class="fab fa-instagram"></a>
            		<a href="#" class="fab fa-linkedin"></a>
         		</div>
         		<p><a href = "login.php">Login</a> | <a href = "register.php">Register</a></p>
         	</div>
         </div>

		 <div class="header-2">
			<div class="flex">
				<a href="home.php" class="logo">Travel</a>
				<nav class="navbar">
					<a href="userabout.php">About Us</a>
					<a href="trips.php">Tours & Packages</a>
					<a href="contact.php">Contact</a>
				</nav>
			</div>
		</div>
     </header>


     <section class = "home">
     	<div class = "content">
     		<h3> Travel around the world</h3>
     		<p> explore,discover,travel</p>
     		<a href = "trips.php" class = "white-btn">discover more</a>
     	</div>
     </section>
     

	<section class="about">
		<div class="flex">
			<div class="image">
				<img src="images/jhhhh.jpg" alt="">
			</div>
			<div class="content">
				<h3>about us</h3>
				<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
				<a href="userabout.php" class="btn">discover more</a>
			</div>
		</div>
	</section>

   <?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>