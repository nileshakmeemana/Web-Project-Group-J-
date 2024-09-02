<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messages</title>
    <link rel="stylesheet" href="../css/messages.css" />
    <link rel="stylesheet" href="../css/admin_header.css" />

  </head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="Dashboard">
      <h1 class="header-1">Messages</h1>
      <div class="tiles">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         if($select_messages->rowCount() > 0){
            while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
      ?>
        <div class="tile 1">
          <h2><span><?= $fetch_message['name']; ?></span></h2>
          <p>User Id: <span><?= $fetch_message['user_id']; ?></p>
          <p>Name: <span><?= $fetch_message['name']; ?></span></p>
          <p>Email: <span><?= $fetch_message['email']; ?></span></p>
          <p>Number: <span><?= $fetch_message['number']; ?></span></p>
          <p>Message:
          <span><?= $fetch_message['message']; ?></span>
          </p>
          <a href="messages.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');"><button>Delete</button></a>
        </div>
        <?php
         }
      }else{
         echo '<p class="empty">you have no messages</p>';
      }
   ?>
      </div>
    </div>

<script src="../js/admin_script.js"></script>
   
</body>
</html>