<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $package_name = $_POST['package_name'];
   $package_price = $_POST['package_price'];
   $package_image = $_POST['package_image'];
   $package_quantity = $_POST['package_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$package_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$package_name', '$package_price', '$package_quantity', '$package_image')") or die('query failed');
      $message[] = 'package added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>paackage</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user_header.php'; ?>

<div class="heading">
   <h3>our packages</h3>
   <p> <a href="userhome.php">home</a> / package </p>
</div>

<section class="packages">

   <h1 class="title">latest packages</h1>

   <div class="box-container">

      <?php  
         $select_packages = mysqli_query($conn, "SELECT * FROM `packages`") or die('query failed');
         if(mysqli_num_rows($select_packages) > 0){
            while($fetch_packages = mysqli_fetch_assoc($select_packages)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_packages['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_packages['name']; ?></div>
      <div class="price">$<?php echo $fetch_packages['price']; ?>/-</div>
      <input type="number" min="1" name="package_quantity" value="1" class="qty">
      <input type="hidden" name="package_name" value="<?php echo $fetch_packages['name']; ?>">
      <input type="hidden" name="package_price" value="<?php echo $fetch_packages['price']; ?>">
      <input type="hidden" name="package_image" value="<?php echo $fetch_packages['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">packages is not added yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>