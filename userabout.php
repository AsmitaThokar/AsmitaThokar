<?php

include 'config.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:login.php');
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user_header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="userhome.php">Home</a> / About Us</p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>This website can be used as a perfect platform to reach your customer with important information.If during a certain period.The travel agency is not taking tour,then throgh their websites they can convey these details to the customers to keep them always inform.</p>
         <p>Thank you for choosing us</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>