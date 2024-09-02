<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders</title>
    <link rel="stylesheet" href="./css/orders.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="Dashboard">
      <h1 class="header-1">Placed Orders</h1>
      <div class="tiles">
      <?php
         if($user_id == ''){
            echo '<p class="empty">please login to see your orders</p>';
         }else{
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if($select_orders->rowCount() > 0){
               while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
        <div class="tile 1">
          <div class="section">
              <div class="set_1">
                    <h2><span><?= $fetch_orders['name']; ?></span></h2>
                    <p>Placed On: <span><?= $fetch_orders['placed_on']; ?></span></p>
                    <p>Email: <span><?= $fetch_orders['email']; ?></span></p>
                    <p>Phone Number: <span><?= $fetch_orders['number']; ?></span</p>
                    <p>Address: <span><?= $fetch_orders['address']; ?></span></p>
                    <p>payment method : <span><?= $fetch_orders['method']; ?></span></p>
                    <p>Your Orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                    <p>Total Price : <span>LKR <?= $fetch_orders['total_price']; ?>/=</span></p>
                    <p>Payment Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'Pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
              </div>
          </div>
        </div>
        <?php
         }
         }else{
            echo '<p class="empty">no orders placed yet!</p>';
         }
         }
      ?>
</div>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>