<?php

include 'config.php';

session_start();

if(!isset($_GET['trip_id'])){
   header('location:trips.php');
}

$trip_id = $_GET['trip_id'];

$trip_query = mysqli_query($conn, "SELECT * FROM `packages` WHERE id = '$trip_id'") or die('query failed1');

if(mysqli_num_rows($trip_query) === 0){
   header('location:trips.php');
}

if(isset($_POST['booking_btn'])){

      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $number = $_POST['number'];
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      // $method = mysqli_real_escape_string($conn, $_POST['method']);
      $address = mysqli_real_escape_string($conn, 'Booking : '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['district']);
   
      $placed_on = date('d-M-Y');

      $bookingSuccess =  mysqli_query($conn, "INSERT INTO `booking`(name, number, email, address, package_id, placed_on) VALUES('$name', '$number', '$email', '$address', '$trip_id','$placed_on')") or die('query failed2');

      $message[] = 'booking placed successfully!';

   }
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
   <h3>Booking</h3>
   <p> <a href="home.php">Home</a> / Booking </p>
</div>

<section class="display-Booking">
   <?php  
      $grand_total = 0;
      $selected_trip = mysqli_query($conn, "SELECT * FROM `packages` WHERE id = '$trip_id'") or die('query failed1');

      if(mysqli_num_rows($selected_trip) > 0){
         while($fetch_cart = mysqli_fetch_assoc($selected_trip)){
   ?>

      <p> 
         <span> Tour Package :  </span>   <?php echo $fetch_cart['name']; ?>  <br />
         <span> Price : </span>           <?php echo '$'.$fetch_cart['price']; ?>  <br />
      </p> 
   <?php
         }
      }
   ?>
</section>

<section class="checkout">

   <form action="" method="post">
      <h3>booking placed</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>Phone Number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <?php
         // <div class="inputBox">
         //    <span>payment method :</span>
         //    <select name="method">
         //       <option value="cash on delivery">cash on delivery</option>
         //       <!-- <option value="credit card">credit card</option> -->
               
         //    </select>
         // </div>
         ?>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" required placeholder="e.g. kanibahal">
         </div>
         <div class="inputBox">
            <span>District :</span>
            <input type="text" name="district" required placeholder="e.g. lalitpur">
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" required placeholder="e.g. nepal">
         </div>
          </div>
      <input type="submit" value="book now" class="btn" name="booking_btn">
   </form>

</section>

<div
    class="service-container"
    data-service="<?= htmlspecialchars($message) ?>"
>

</div>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.ready(function() {
        querySelect('.service-container').each(function() {
            var container = $(this);
            var service = container.data('service');

            if(service){
               Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 2000
               })
            }

            // Var "service" now contains the value of $myService->getValue();
        });
    });
</script>

</body>
</html>