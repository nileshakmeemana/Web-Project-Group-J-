<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products</title>
    <link rel="stylesheet" href="../css/products.css" />
    <link rel="stylesheet" href="../css/admin_header.css" />

  </head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="log-form">
      <div class="header">
        <h1 class="header-1">Add Product</h1>
        <p class="header-title">Enter Your Product Details and Images</p>
      </div>
      <form action=""  method="post" enctype="multipart/form-data">
        <div class="product_details">
          <input type="text" placeholder="Enter Product Name" required maxlength="100" name="name"/>
          <input type="number" placeholder="Enter Product Price" min="0" class="box" required max="9999999999" onkeypress="if(this.value.length == 10) return false;" name="price"/>
        </div>
        <div class="product_details">
          <input type="file" placeholder="Choose Images" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" required/>
          <input type="file" placeholder="Choose Images" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" required/>
        </div>
        <div class="product_details">
          <input type="file" placeholder="Choose Images" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" required/>
          <input type="text" placeholder="Product Stock" name="details" required maxlength="500"/>
        </div>
        <input type="submit" value="Add Product" class="btn_1" name="add_product">
      </form>
    </div>
    <div class="Dashboard">
      <h1 class="header-1">All Products</h1>
      <div class="all">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
      ?>
          <div class="tiles">
            <div class="tile 1">
              <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
              <h5 style="color: gray;">WAREHOUSE</h5>
              <h4><?= $fetch_products['name']; ?></h4>
              <p class="price">LKR <span><?= $fetch_products['price']; ?></span>/=</p>
              <p class="stock"><span><?= $fetch_products['details']; ?></span></p>
              <div class="all_buttons">
                <a href="update_product.php?update=<?= $fetch_products['id']; ?>"><button class="btn" style="width: 200px; margin: 0px; margin-bottom: 10px; background-color: #1e2d7d;">Update</button></a>
                <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');"><button style="background-color: #ff0548; width: 200px; margin: 0px;">Delete</button></a>
              </div>
          </div>
          <?php
               }
            }else{
               echo '<p class="empty">no products added yet!</p>';
            }
         ?>
   
      </div>
    </div>

<script src="../js/admin_script.js"></script>
   
</body>
</html>