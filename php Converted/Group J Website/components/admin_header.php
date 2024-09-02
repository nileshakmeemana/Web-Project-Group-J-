<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="admin">
      <div class="nav-bar">
        <a href="dashboard.php" class="logo">
          <img class="header-logo" src="../images/Logo.webp" alt="logo" />
        </a>
        <div class="tabs">
          <ul>
            <li><a href="../admin/dashboard.php">Home</a></li>
            <li><a href="../admin/products.php">All Products</a></li>
            <li><a href="../admin/placed_orders.php">Orders</a></li>
            <li><a href="../admin/admin_accounts.php">Admins</a></li>
            <li><a href="../admin/users_accounts.php">Users</a></li>
            <li><a href="../admin/messages.php">Messages</a></li>
            <li><a href="../admin/update_profile.php">Update Profile</a></li>
          </ul>
        </div>
        <div class="buttons">
        <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
          <?= $fetch_profile['name']; ?>
          <a href="../admin/admin_login.php"><button>Login</button></a>
          <a href="../components/admin_logout.php" onclick="return confirm('logout from the website?');"><button>Logout</button></a>
          <a href="../admin/register_admin.php"><button>Register</button></a>
        </div>
      </div>
    </header>