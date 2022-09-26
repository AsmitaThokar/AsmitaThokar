<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_package'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_package_name = mysqli_query($conn, "SELECT name FROM `packages` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_package_name) > 0){
      $message[] = 'package has already added';
   }else{
      $add_package_query = mysqli_query($conn, "INSERT INTO `packages`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

      if($add_package_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'package added successfully!';
         }
      }else{
         $message[] = 'package could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   die('reached here in die');
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `packages` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `packages` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_packages.php');
}

if(isset($_POST['update_package'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `packages` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `packages` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_packages.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>packages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/table.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-packages">

   <h1 class="title">Tour packages</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>add tour package</h3>
      <input type="text" name="name" class="box" placeholder="enter package name" required><br>
      <input type="number" min="0" name="price" class="box" placeholder="enter package price" required><br>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required><br>
      <input type="submit" value="add package" name="add_package" class="btn">
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->
<section class="dashboard">
<div class="box-container">
	<table>
		<tr>
         <th>S.N.</th>
         <th>Package Name</th>
         <th>Package Price</th>
         <th>Image</th>
         <th>Action</th>
      </tr>
      <?php

         $select_packages = mysqli_query($conn, "SELECT * FROM `packages`") or die('query failed');
         $sn=1;
         if(mysqli_num_rows($select_packages) > 0){
            while($fetch_packages = mysqli_fetch_assoc($select_packages)){
      ?>
      <tr>
         <td><?php echo $sn; ?></td>
         <td> <?php echo $fetch_packages['name']; ?></td>
         <td> $<?php echo $fetch_packages['price']; ?></td>
         <td><img width="20%" src="uploaded_img/<?php echo $fetch_packages['image']; ?>" alt=""></td>
         <td>
            <a href="admin_packages.php?update=<?php echo $fetch_packages['id']; ?>" class="option-btn">update</a>
            <a href="admin_packages.php?delete=<?php echo $fetch_packages['id']; ?>" class="delete-btn" onclick="return confirm('delete this package?');">delete</a>
         </td>
      </tr>
      <?php
         $sn++;
         }
      }else{
         echo '<tr> <td  colspan="5"> <p class="empty">package is not added yet!</p> </td> </tr>';
      }
      ?>
   </table>
</div>
</section>

<section class="edit-package-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `packages` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter package name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter package price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpg, image/png">
      <input type="submit" value="update" name="update_package" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-package-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>