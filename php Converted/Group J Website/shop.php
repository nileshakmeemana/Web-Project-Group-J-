<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Products</title>
    <link rel="stylesheet" href="./css/shop.css" />
    <script
      src="https://kit.fontawesome.com/6f47df0af3.js"
      crossorigin="anonymous"
    ></script>
  </head>
   
<?php include 'components/user_header.php'; ?>

<body>
    <div class="Dashboard">
      <h1 class="header-1">All Products</h1>
      <div class="all">
          <div class="tiles">
          <?php
            $select_products = $conn->prepare("SELECT * FROM `products`"); 
            $select_products->execute();
            if($select_products->rowCount() > 0){
               while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
          ?>
            <div class="tile 1">
            <form action="" method="post">
               <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
              <span><button type="submit" name="add_to_wishlist" class="icon"><i class="fa-solid fa-heart"></i></button></span>
              <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
              <h5 style="color: gray;">WAREHOUSE</h5>
              <h4><?= $fetch_product['name']; ?></h4>
              <p class="price"><span>LKR </span><?= $fetch_product['price']; ?><span>/=</span></p>
              <div class="sq">
                <p class="stock">In Stock</p>
                <input type="number" name="qty" class="qty" min="1" max="30" onkeypress="if(this.value.length == 2) return false;" value="1">
              </div>
              <input type="submit" value="Add To Cart" class="btn_1" name="add_to_cart">
              <div class="link"><a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="btn_2">Buy Now</a></div>
            </form>
          </div>
          <?php
               }
            }else{
               echo '<p class="empty">no products found!</p>';
            }
          ?>
        </div>
    </div>
  </body>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>