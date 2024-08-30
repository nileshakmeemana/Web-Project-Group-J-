<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Accounts</title>
    <link rel="stylesheet" href="../css/admin_accounts.css" />
  </head>
<body>

<?php include '../components/admin_header.php'; ?>


<div class="Dashboard">
      <h1 class="header-1">Admin Accounts</h1>
      <div class="tiles">
        <div class="tile 1">
          <h2>Add New Admin</h2>
          <a href="register_admin.php"><button>Register Admin</button></a>
        </div>
        <?php
            $select_accounts = $conn->prepare("SELECT * FROM `admins`");
            $select_accounts->execute();
            if($select_accounts->rowCount() > 0){
            while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
         ?>
        <div class="tile 1">
       
           
           <h2>Admin Details</h2>
           <p>Admin Id: <span><?= $fetch_accounts['id']; ?></span></p>
           <p>Admin Name:  <span><?= $fetch_accounts['name']; ?></span></p>
           <div class="btn">

            <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="update_profile.php"><button class="btn_1">Update</button></a>';
            }
            ?>

            <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>"  onclick="return confirm('delete this account?')">
            <button style="background-color: #ff0548" class="btn_2">
               Delete
            </button></a>
          </div>

          <?php
               }
            }else{
               echo '<p class="empty">no accounts available!</p>';
            }
            ?>
        </div>
      </div>
   </div></div>

<script src="../js/admin_script.js"></script>
   
</body>
</html>