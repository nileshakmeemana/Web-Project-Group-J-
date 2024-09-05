<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Cart</title>
    <link rel="stylesheet" href="./css/cart.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="Dashboard">
      <h1 class="header-1">Your Cart</h1>
      <div class="all">
          <div class="tiles">
          <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
               while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
         ?>
            <div class="tile 1">
            <form action="" method="post" class="box">
              <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
              <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
              <h5 style="color: gray;">WAREHOUSE</h5>
              <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" style="text-decoration-line:none;">
                 <h4><?= $fetch_cart['name']; ?></h4>
              </a>
              <p class="price">LKR <?= $fetch_cart['price']; ?>/=</p>
              <div class="sq">
                <p class="stock">In Stock</p>
                <input type="number" name="qty" class="qty" min="1" max="30" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                <button style="width: 60px; background-color:#1e2d7d" type="submit"  name="update_qty">Edit</button>
               </div>
               <p class="total">Total: <span>LKR <?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/=</span></p>
              <a href="shop.php"><button style="background-color: #31c6e1; margin-top: 10px;" class="btn">Continue Shopping</button></a>
              <input type="submit" value="Delete Item" onclick="return confirm('delete this from cart?');" class="btn" name="delete">
            </form>
          </div>
          <?php
            $grand_total += $sub_total;
               }
            }else{
               echo '<p class="empty">Your Cart Is Empty</p>';
            }
            ?>
        </div>
        <div class="check_tile">
          <div class="check">
              <h2>Grand Total: <span>LKR <?= $grand_total; ?>/=</span></h2>
              <div><a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>"><button style="background-color: #1e2d7d" class="btn">Proceed To Checkout</button></a></div>
              <div><a href="shop.php"><button style="background-color: #31c6e1" class="btn">Continue Shopping</button></a></div>
              <div><a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');""><button class="btn">Delete Items</button></a></div>
          </div>
        </div>
    </div>
  </body>











<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>