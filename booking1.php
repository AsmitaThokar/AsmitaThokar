<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>booking</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/table.css">

</head>
<body>
   
<?php include 'user_header.php'; ?>

<div class="heading">
   <h3>booking</h3>
   <p> <a href="home.php">userhome</a> / booking </p>
</div>

<section class="show-packages">
   <table>
      <tr>
         <th>S.N.</th>
         <th>Total Package</th>
         <th>Total Price</th>
         <th>Payment Method</th>
         <th>Booking Date </th>
      </tr>
      <?php
       $sn=1;
      $booking_query = mysqli_query($conn, "SELECT * FROM `booking` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($booking_query) > 0){
         while($fetch_booking = mysqli_fetch_assoc($booking_query)){
      ?>
      <tr>
         <td><?php echo $sn; ?></td>
         <td> <?php echo $fetch_booking['total_packages']; ?></td>
         <td> <?php echo $fetch_booking['total_price']; ?></td>
         <td> <?php echo $fetch_booking['method']; ?></td>
         <td> <?php echo $fetch_booking['placed_on']; ?></td>
      </tr>
      <?php
         $sn++;
         }
      }else{
         echo '<tr> <td  colspan="11"> <p class="empty">not booked yet</p> </td> </tr>';
      }
      ?>
   </table>
</section>


<?php include 'footer.php'; 
?>

<!-- custom js file link  -->
<script src="js/script.js">
   
</script>

</body>
</html>