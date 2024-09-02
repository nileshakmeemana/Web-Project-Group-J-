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
    <title>Product Page</title>
    <link rel="stylesheet" href="./css/quick_view.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>
<div class="Card">
      <h1 class="header-1" style="text-align: center;">Quick View</h1>
         <div class="tiles">
         <?php
            $pid = $_GET['pid'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
            $select_products->execute([$pid]);
            if($select_products->rowCount() > 0){
               while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         ?>
           <div class="tile1 1">
           <form action="" method="post">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
             <div class="slider">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" />
               <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="" />
               <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="" />
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" />
             </div>
             <div class="main_img">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" />
            </div>
           </div>
           <div class="tile2 2">
             <h2 class="header-1">
             <?= $fetch_product['name']; ?>
             </h2>
             <h4 class="tag">Save LKR 3000</h4>
             <p class="product_tags">
               Price: <span style="font-size: 25px"><span style="margin-left: 0px;">LKR </span><?= $fetch_product['price']; ?><span style="margin-left: 0px;">/=</span></span>
             </p>
             <p class="product_tags">
               Stock: <span style="color: green">In Stock</span>
             </p>
             <p class="product_tags">Details:</p>
             <p class="product_tags">
               Feel the freedom and love the bass with these Bluetooth headphones
               with EXTRA BASS that deliver powerful, clear sound and up to 18
               hours of battery life.
             </p>
             <div class="counter">
               <p class="product_tags">Quantity:</p>
               <input type="number" class="counter" name="qty" min="1" max="30" onkeypress="if(this.value.length == 2) return false;" value="1"/>
             </div>
             <div class="btn">
               <button class="btn_1" name="add_to_cart">Add To Cart</button>
               <button class="btn_2"  name="add_to_wishlist">Add To Wishlist</button>
             </div>
            </form>
           </div>
         <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
         </div>
         <div class="Delivery">
           <div class="Shipping">
             <div>
               <h2 class="header-1">Shipping and Returns</h2>
               <ul>
                 <li>
                   Delivery is free for all orders over $80. Otherwise, delivery is
                   $8-$25 depending on the items you plan to purchase.
                 </li>
                 <li>
                   Once your product has shipped, it usually takes 2 to 3 business
                   days in USA, 3 to 8 in Europe. 5 to 15 for the rest of the
                   world.
                 </li>
                 <li>
                   You can return your product up to 14 days after receiving your
                   order. Please make sure that the products are not used or
                   damaged.
                 </li>
               </ul>
             </div>
           </div>
           <div class="Offers">
             <div>
               <h2 class="header-1">
                 Special Offers!
                 <p style="margin-top: 20px">Buy One Get One Free</p>
                 <p style="background-color: rgb(229, 6, 169)">
                   Black Friday Offer
                 </p>
                 <p style="background-color: #1e2d7d">50% Off On JBL Products</p>
               </h2>
             </div>
           </div>
         </div>
         <div class="Payments">
           <h2 class="header-1">Payment & Security</h2>
           <p style="margin-bottom: 0px; color: #1e2d7d; font-weight: bold">
             PAYMENT METHODS
           </p>
           <div class="paycards">
             <img
               src="../images/american-express.png"
               alt=""
               style="padding-left: 0px"
             />
             <img src="../images/visa.png" alt="" />
             <img src="../images/card (1).png" alt="" />
             <img src="../images/card (2).png" alt="" />
             <img src="../images/card.png" alt="" />
           </div>
           <p class="desc">
             Your payment information is processed securely. We do not store credit
             card details nor have access to your credit card information. Our
             policy lasts 30 days. If 30 days have gone by since your purchase,
             unfortunately we can’t offer you a refund or exchange. To be eligible
             for a return, your item must be unused and in the same condition that
             you received it. It must also be in the original packaging.
           </p>
           <button class="google">Google Pay</button>
           <button class="paypal">Pay Pal</button>
           <button class="cash">Cash On Delivery</button>
         </div>
       </div>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>