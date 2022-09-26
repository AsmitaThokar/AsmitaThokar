<?php

$conn = mysqli_connect('localhost','root','','tats') or die('connection failed');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Travel Homepage</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/custom.css">
</head>
<body>

	 <?php include 'user_header.php'; ?>

     <section class = "home">
     	<div class = "content">
     		<h3> Travel around the world</h3>
     		<p> Travel | Explore | Discover</p>
     		<a href = "trips.php" class = "white-btn">discover more</a>
     	</div>
     </section>
     

	<section class="about">
		<div class="flex">
			<div class="image">
				<img src="images/gokyo.jpg" alt="">
			</div>
			<div class="content">
				<h3>about us</h3>
				<p>Travel is a Nepal Government registered trekking/expedition/tour company with over a decade of experience in eco-tourism. On the way, you will get to experience pristine woodlands, deep gorges, high snow peaks, traditional yet diverse Nepali cultures, & welcoming people. If you are looking for a life-changing experience, visit Nepal, and we will take you on a journey you will remember throughout your life.</p>
				<a href="userabout.php" class="btn">More about us</a>
			</div>
		</div>
	</section>

   <?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>