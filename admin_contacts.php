<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/table.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>


<!-- show messages  -->
<section class="show-messages">
	<table>
		<tr>
         <th>S.N.</th>
         <th>Name</th>
         <th>Number</th>
         <th>Email</th>
         <th>Message</th>
         <th>Action</th>
      </tr>
      <?php

         $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
         $sn=1;
         if(mysqli_num_rows($select_message) > 0){
            while($fetch_message = mysqli_fetch_assoc($select_message)){
      ?>
      <tr>
         <td><?php echo $sn; ?></td>
         <td> <?php echo $fetch_message['name']; ?></td>
         <td> <?php echo $fetch_message['number']; ?></td>
         <td> <?php echo $fetch_message['email']; ?></td>
         <td> <?php echo $fetch_message['message']; ?></td>
         <td>
         <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>         </td>
      </tr>
      <?php
         $sn++;
         }
      }else{
         echo '<tr> <td colspan="6"> <p class="empty"> you have no messages! </td> </tr>';
      }
      ?>
   </table>
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>