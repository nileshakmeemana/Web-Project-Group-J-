<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/admin_login.css" />
  </head>
<body>

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

<div class="log-form">
      <div class="header">
        <h1 class="header-1">Login to my admin account</h1>
        <p class="header-title">Enter your email and password</p>
        <p>Default Username = <span>Admin</span> & Password = <span>111</span></p>

      </div>
      <form action="" method="post" class="admin-login">
        <input type="text" name="name" placeholder="Username" maxlength="20" required oninput="this.value = this.value.replace(/\s/g, '')" />
        <input type="password" placeholder="Password" name="pass" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input type="submit" value="Login" class="btn" name="submit">
      </form>
      <div class="footer">
        <!-- <p>Need an account? Sign up <a href="register_admin.php">here</a></p> -->
      </div>
    </div>
   
</body>
</html>