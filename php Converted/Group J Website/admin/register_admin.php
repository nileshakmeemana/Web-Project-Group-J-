<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $message[] = 'username already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'new admin registered successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/register_admin.css" />
  </head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="log-form">
      <div class="header">
        <h1 class="header-1">Create my admin account</h1>
        <p class="header-title">Please fill in the information below</p>
      </div>
      <form action="" method="post">
        <input type="text" placeholder="Enter Your Username" name="name" required maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input type="password" placeholder="Enter Your Password" name="pass" required  maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input type="password" placeholder="Re-Enter Your Password" name="cpass" required  maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" />
        <input type="submit" value="Create My Account" class="btn" name="submit">

      </form>
      <div class="footer">
        <p>Already have an account? Login here <a href="admin_login.php">here</a></p>
      </div>
    </div>


<script src="../js/admin_script.js"></script>
   
</body>
</html>