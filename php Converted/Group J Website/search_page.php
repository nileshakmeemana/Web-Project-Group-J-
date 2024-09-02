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
    <title>Search</title>
    <link rel="stylesheet" href="./css/search_page.css" />
    <script
      src="https://kit.fontawesome.com/6f47df0af3.js"
      crossorigin="anonymous"
    ></script>
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="search_box">
      <form action="" method="post">
         <div class="search_bar">
            <input type="text" placeholder="Search..." name="search_box" maxlength="100" required/>
            <button type="submit" name="search_btn">Search</button>
          </div>
      </form>
</section>


<div class="Dashboard">
      <div class="all">
          <div class="tiles">
          <?php
            if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'"); 
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
              <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>"style="text-decoration-line:none;">
                 <h4><?= $fetch_product['name']; ?></h4>
              </a>
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
         }
          ?>
        </div>
    </div>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>