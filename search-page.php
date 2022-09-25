<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

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

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>search page</h3>
   <p> <a href="userhome.php">home</a> / search </p>
</div>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="search package..." class="box">
      <input type="submit" name="submit" value="search" class="btn">
   </form>
</section>

<section class="packages" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_packages = mysqli_query($conn, "SELECT * FROM `packages` WHERE name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_packages) > 0){
         while($fetch_package = mysqli_fetch_assoc($select_ps)){
   ?>
   <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_package['image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_package['name']; ?></div>
      <div class="price">$<?php echo $fetch_package['price']; ?>/-</div>
      <input type="number"  class="qty" name="package_quantity" min="1" value="1">
      <input type="hidden" name="package_name" value="<?php echo $fetch_package['name']; ?>">
      <input type="hidden" name="package_price" value="<?php echo $fetch_package['price']; ?>">
      <input type="hidden" name="package_image" value="<?php echo $fetch_package['image']; ?>">
      <input type="submit" class="btn" value="add to cart" name="add_to_cart">
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">no result found!</p>';
         }
      }else{
         echo '<p class="empty">search something!</p>';
      }
   ?>
   </div>
  

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>