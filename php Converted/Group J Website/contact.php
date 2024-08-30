<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="./css/contact.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="contact-form">
      <div class="header">
        <h1 class="header-1">Contact Us</h1>
        <p class="header-title">Want to get in touch with us?</p>
        <p class="header-title">
          Just fill out the form below and we'll get back to you as soon as
          possible.
        </p>
      </div>
      <form action="" method="post">
        <input name="name" required type="text" placeholder="Your Name" maxlength="20"/>
        <input name="email" required type="email" placeholder="Email" maxlength="50"/>
        <!-- <select required>
          <option value disabled selected>Who do you want to contact</option>
          <option>Customer Service</option>
          <option>Partnership</option>
          <option>Press</option>
          <option>Legal</option>
        </select> -->
        <input type="number" name="number" min="0" max="9999999999" placeholder="Enter Your Number" required onkeypress="if(this.value.length == 10) return false;">
        <textarea
          name="msg"
          id=""
          cols="30"
          rows="10"
          placeholder="Your message"
        ></textarea>

        <input type="submit" value="Send Message" name="send" class="btn">
      </form>
      <div class="footer">
        <p>Find more details about us! <a href="about.php">here</a></p>
      </div>
    </div>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>