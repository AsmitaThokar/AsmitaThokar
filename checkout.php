<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['booking_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   // $address = mysqli_real_escape_string($conn, 'Booking '. $_POST['flat'].', '.', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $address = mysqli_real_escape_string($conn, 'Booking , '.', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['district']);
  
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_packages[] = '';
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_packages[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_packages = implode(', ',$cart_packages);


   $order_query = mysqli_query($conn, "SELECT * FROM `booking` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_packages = '$total_packages' AND total_price = '$cart_total'") or die('query failed');


   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){

         $message[] = 'already booked'; 
      }else{

        $bookingSuccess =  mysqli_query($conn, "INSERT INTO `booking`(user_id, name, number, email, method, address, total_packages, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_packages', '$cart_total', '$placed_on')") or die('query failed');

if($bookingSuccess){
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

}

         $message[] = 'booking placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

// else {
//    die('else');
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user_header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-Booking">
       <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
         ?>

      <p> <?php echo $fetch_cart['name']; ?> 
         <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> 
      </p> <br>
         <?php
            }
         }else{
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>
   
      <div class="grand-total"> Grand Total : <span> $<?php echo $grand_total; ?>  </span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>booking placed</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <!-- <option value="credit card">credit card</option> -->
               
            </select>
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. kanibahal">
         </div>
         <div class="inputBox">
            <span>district :</span>
            <input type="text" name="district" required placeholder="e.g. lalitpur">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. nepal">
         </div>
          </div>
      <input type="submit" value="booked now" class="btn" name="booking_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>