<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/admin_header.css" />
  </head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="Dashboard">
        <h1 class="header-1">Dashboard</h1>
        <div class="tiles">
            <div class="tile 1">
                <h2>Welcome</h2>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="update_profile.php"><button>Update Profile</button></a>
            </div>
            <div class="tile 1">
                <?php
                  $total_pendings = 0;
                  $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                  $select_pendings->execute(['pending']);
                  if($select_pendings->rowCount() > 0){
                     while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pendings['total_price'];
                     }
                  }
               ?>
                <h2><span>LKR </span><?= $total_pendings; ?><span>/=</span></h2>
                <p>Total Pendings</p>
                <a href="placed_orders.php"><button>See Orders</button></a>
            </div>
            <div class="tile 1">
            <?php
               $total_completes = 0;
               $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
               $select_completes->execute(['completed']);
               if($select_completes->rowCount() > 0){
                  while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                     $total_completes += $fetch_completes['total_price'];
                  }
               }
            ?>
                <h2><span>LKR </span><?= $total_completes; ?><span>/=</span></h2>
                <p>Completed Orders</p>
                <a href="placed_orders.php"><button>See Orders</button></a>
            </div>


            <div class="tile 1">
               <?php
                  $select_orders = $conn->prepare("SELECT * FROM `orders`");
                  $select_orders->execute();
                  $number_of_orders = $select_orders->rowCount()
               ?>
                <h2><?= $number_of_orders; ?></h2>
                <p>Orders Placed</p>
                <a href="placed_orders.php"><button>See Orders</button></a>
            </div>

        </div>
        <div class="tiles">
            <div class="tile 1">
            <?php
               $select_products = $conn->prepare("SELECT * FROM `products`");
               $select_products->execute();
               $number_of_products = $select_products->rowCount()
            ?>
                <h2><?= $number_of_products; ?></h2>
                <p>Products Added</p>
                <a href="products.php"><button>See Products</button></a>
            </div>

            <div class="tile 1">
            <?php
               $select_users = $conn->prepare("SELECT * FROM `users`");
               $select_users->execute();
               $number_of_users = $select_users->rowCount()
            ?>
                <h2><?= $number_of_users; ?></h2>
                <p>Normal Users</p>
                <a href="users_accounts.php"><button>See Users</button></a>
            </div>

            <div class="tile 1">
            <?php
               $select_admins = $conn->prepare("SELECT * FROM `admins`");
               $select_admins->execute();
               $number_of_admins = $select_admins->rowCount()
            ?>
                <h2><?= $number_of_admins; ?></h2>
                <p>Admin Users</p>
                <a href="admin_accounts.php"><button>See Admin Users</button></a>
            </div>

            <div class="tile 1">
            <?php
               $select_messages = $conn->prepare("SELECT * FROM `messages`");
               $select_messages->execute();
               $number_of_messages = $select_messages->rowCount()
            ?>
                <h2><?= $number_of_messages; ?></h2>
                <p>New Messages</p>
                <a href="messages.php"><button>See Messages</button></a>
            </div>
        </div>
    </div>
    </div>


<script src="../js/admin_script.js"></script>
   
</body>
</html>