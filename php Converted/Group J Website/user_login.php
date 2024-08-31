<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['password']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
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
    <title>Login</title>
    <link rel="stylesheet" href="./css/user_login.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

   <div class="log-form">
      <div class="header">
        <h1 class="header-1">Login to my account</h1>
        <p class="header-title">Enter your email and password</p>
      </div>
      <form action="" method="post">
        <input type="email" name="email" required placeholder="Email" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input type="password" required placeholder="Password" name="password" id="" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input type="submit" value="Login" class="btn" name="submit">
      </form>

      <div class="footer">
        <p>Need an account? Sign up <a href="user_register.php">here</a></p>
      </div>
    </div>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>