<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_orders->execute([$delete_id]);
   $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
   $delete_messages->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Accounts</title>
    <link rel="stylesheet" href="../css/user_accounts.css" />
  </head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="Dashboard">
      <h1 class="header-1">User Accounts</h1>
      <div class="tiles">
      <?php
      $select_accounts = $conn->prepare("SELECT * FROM `users`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
        <div class="tile 1">
          <h2>User Details</h2>
          <p>User Id: <span><?= $fetch_accounts['id']; ?></span> </p>
          <p>User Name: <span><?= $fetch_accounts['email']; ?></span></p>
          <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account? the user related information will also be delete!')">
             <button style="background-color: #ff0548" class="btn_2">
               Delete
             </button>
          </a>
        </div>
        <?php
            }
         }else{
            echo '<p class="empty">no accounts available!</p>';
         }
      ?>
      </div>
    </div>

<script src="../js/admin_script.js"></script>
   
</body>
</html>