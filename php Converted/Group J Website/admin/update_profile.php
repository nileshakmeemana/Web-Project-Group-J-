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

   $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
   $update_profile_name->execute([$name, $admin_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $confirm_pass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$confirm_pass, $admin_id]);
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
    <title>Update Profile</title>
    <link rel="stylesheet" href="../css/update_profile.css" />
  </head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="log-form">
      <div class="header">
        <h1 class="header-1">Update my admin account</h1>
        <p class="header-title">Please fill in the information below</p>
      </div>
      <form action="" method="post">
        <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
        <input type="text" placeholder="Username" name="name" value="<?= $fetch_profile['name']; ?>" required maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" />
        <input type="password" placeholder="Enter Old Password"  name="old_pass" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input type="password" placeholder="Enter New Password" name="new_pass" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')"/>
        <input
          type="password"
          placeholder="Re-Enter New Password"
          name="confirm_pass" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')"
        />
        <input type="submit" value="Update Account" class="btn" name="submit">
      </form>

      <!-- <div class="footer">
        <p>Already have an account? Login here <a href="#">here</a></p>
      </div>
    </div> -->

<script src="../js/admin_script.js"></script>
   
</body>
</html>