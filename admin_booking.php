<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_booking'])){

   $booking_update_id = $_POST['booking_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `packages` SET payment_status = '$update_payment' WHERE id = '$booking_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `booking` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_booking.php');
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

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/table.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="booking">
   

   <h1 class="title">has been booked</h1>

   <!-- product CRUD section ends -->

<!-- show products  -->
<section class="show-packages">
	<table>
		<tr>
         <th>S.N.</th>
         <th>User Name</th>
         <th>User Phone No.</th>
         <th>User Email</th>
         <th>User Address</th>
         <th>Total Package</th>
         <th>Total Price</th>
         <th>Payment Method</th>
         <th>Booking Date </th>
         <th>Booking Status </th>
         <th>Action</th>
      </tr>
      <?php
       $sn=1;
      $select_booking = mysqli_query($conn, "SELECT * FROM `booking`") or die('query failed');
      if(mysqli_num_rows($select_booking) > 0){
         while($fetch_booking = mysqli_fetch_assoc($select_booking)){
      ?>
      <tr>
         <td><?php echo $sn; ?></td>
         <td> <?php echo $fetch_booking['name']; ?></td>
         <td> <?php echo $fetch_booking['number']; ?></td>
         <td> <?php echo $fetch_booking['email']; ?></td>
         <td> <?php echo $fetch_booking['address']; ?></td>
         <td> <?php echo $fetch_booking['total_packages']; ?></td>
         <td> <?php echo $fetch_booking['total_price']; ?></td>
         <td> <?php echo $fetch_booking['method']; ?></td>
         <td> <?php echo $fetch_booking['placed_on']; ?></td>
         <td>
            <form action="" method="post">
               <input type="hidden" name="booking_id" value="<?php echo $fetch_booking['id']; ?>">
               <select name="update_payment">
                  <option value="" selected disabled><?php echo $fetch_booking['payment_status']; ?></option>
                  <option value="pending">pending</option>
                  <option value="completed">completed</option>
               </select>
               <!-- <input type="submit" value="update" name="update_booking" class="option-btn"> -->
            </form>
         </td>
         <td>
            <a href="admin_booking.php?delete=<?php echo $fetch_booking['id']; ?>" onclick="return confirm('delete this booking?');" class="delete-btn">delete</a>
         </td>
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

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>