<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your cart is empty';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>
    <link rel="stylesheet" href="./css/checkout.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>
   <div class="log-form">
      <div class="header">
        <h1 class="header-1">Checkout</h1>
        <p class="header-title">Place Your Order</p>
      </div>
      <div class="checkout">
        <form action="" method=post>
          <div class="checkout_form">
             <div class="product_details">
               <input type="text" placeholder="Enter Your Name" name="name" maxlength="20" required/>
               <input type="number" placeholder="Enter Your Number" name="number" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required/>
             </div>
             <div class="product_details">
               <input type="email" placeholder="Enter Your Email" name="email" maxlength="50" required/>
               <select name="method" required>
                 <option value disabled selected>Payment Method</option>
                 <option>Cash On Delivery</option>
                 <option>PayPal</option>
                 <option>Google Pay</option>
               </select>
             </div>
             <div class="product_details">
               <input type="text" placeholder="Address Line 01" name="flat" maxlength="50" required/>
               <input type="text" placeholder="Address Line 02" name="street" maxlength="50" required/>
             </div>
             <div class="product_details">
               <input type="text" placeholder="Enter Your City" name="city" maxlength="50" required/>
               <input type="text" placeholder="Enter Your State" name="state" maxlength="50" required/>
             </div>
             <div class="product_details">
               <input type="text" placeholder="Enter Your Country" name="country" maxlength="50" required/>
               <input type="text" placeholder="Enter Your Zipcode" min="0" name="pin_code" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" required/>
             </div>
             <button type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Place Order</button>
          </div>
         
             <div class="check">
                <?php
                  $grand_total = 0;
                  $cart_items[] = '';
                  $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                  $select_cart->execute([$user_id]);
                  if($select_cart->rowCount() > 0){
                     while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                        $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                        $total_products = implode($cart_items);
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                  ?>
                            <h3>Your Orders</h3>
                            <div class="product-tile">
                  <p> <?= $fetch_cart['name']; ?> <span>(<?= 'LKR '.$fetch_cart['price'].'/- x '. $fetch_cart['quantity']; ?>)</span> </p>
                            </div>
                            <?php
                  }
                            }else{
                  echo '<p class="empty">your cart is empty!</p>';
                            }
                         ?>
                         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
                         <div class="grand-total"><h2>Grand Total : <span>LKR <?= $grand_total; ?>/=</span></h2></div>
             </div>
      </form>
          <!-- <div class="product-tile">
            <p>Sony Headset 300ed ($2500/- x 1)</p>
          </div>
          <div class="product-tile">
            <p>Sony Headset 300ed ($2500/- x 1)</p>
          </div>
          <div class="product-tile">
            <p>Sony Headset 300ed ($2500/- x 1)</p>
          </div>
          <div class="product-tile">
            <p>Sony Headset 300ed ($2500/- x 1)</p>
          </div>
          <div class="product-tile">
            <p>Sony Headset 300ed ($2500/- x 1)</p>
          </div> -->
        </div>
      </div>
    </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>