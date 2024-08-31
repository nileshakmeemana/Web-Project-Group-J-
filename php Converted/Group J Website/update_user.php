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

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $cpass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $message[] = 'password updated successfully!';
      }else{
         $message[] = 'please enter a new password!';
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
    <title>Update My Account</title>
    <link rel="stylesheet" href="./css/update_user.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="log-form">
      <div class="header">
        <h1 class="header-1">Update my account</h1>
        <p class="header-title">Please fill in the information below</p>
      </div>
      <form action="" method="post">
         <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>"> 
        <input type="text" name="name" required placeholder="Username" value="<?= $fetch_profile["name"]; ?>"/>
        <input type="email" name="email" required placeholder="Email" value="<?= $fetch_profile["email"]; ?>" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input type="password" name="old_pass" placeholder="Enter Old Password" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input type="password" name="new_pass" placeholder="Enter New Password" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input
          type="password"
          placeholder="Re-Enter New Password"
          name="cpass"
          id="" oninput="this.value = this.value.replace(/\s/g, '')"
        />
        <input type="submit" value="Update my account" class="btn" name="submit">
      </form>
    </div>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>