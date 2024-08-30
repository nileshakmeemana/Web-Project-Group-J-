<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'registered successfully, login now please!';
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
    <title>Create Account</title>
    <link rel="stylesheet" href="./css/user_register.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="log-form">
      <div class="header">
        <h1 class="header-1">Create my account</h1>
        <p class="header-title">Please fill in the information below</p>
      </div>
      <form action="" method="post">
        <input type="text" required placeholder="Enter Your Username" name="name" maxlength="20"/>
        <input type="email" required placeholder="Enter Your Email" maxlength="50" name="email" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input
          type="password"
          required
          placeholder="Enter Your Password"
          name="pass" maxlength="20"
          id=""
          oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input
          type="password"
          required
          placeholder="Re Enter Your Password"
          name="cpass" maxlength="20"
          id=""
          oninput="this.value = this.value.replace(/\s/g, '')"/>

         <input type="submit" value="Create My Account" class="btn" name="submit">
      </form>
      <div class="footer">
        <p>Already have an account? Login here <a href="user_login.php">here</a></p>
      </div>
    </div>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>