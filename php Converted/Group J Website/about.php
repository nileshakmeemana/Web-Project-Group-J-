<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="UTF-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>About Us</title>
     <link rel="stylesheet" href="./css/about.css" />
   </head>
   
   <body>
     <?php include 'components/user_header.php'; ?>
    <div class="about-us">
      <div class="header">
        <h1 class="header-1">About Us</h1>
        <p class="header-2">Why choose HiDEF Lifestyle?</p>
        <p class="header-title">
          Our mission statement is to provide the absolute best customer
          experience available in the Audio/Video industry without exception. We
          choose to only sell the best performing products in the world,
          learning them inside and out to ensure your experience with our
          organization and the products we supply is second to none. HiDEF
          Lifestyle is one of the fastest growing Audio and Video retailers in
          the United States. All because of our passion for our products and our
          customers. We care like no one else.
        </p>
        <img src="./project images/1.webp" alt="" />
        <p>
          We employ salaried representatives whose primary focus is to know and
          love our products and our customers. Our reps have an average of 7
          years of industry experience and go through product trainings and
          certifications on a weekly basis. You will not find another source
          that has more industry involved reps on call for you all the time. We
          only sell what we would and do have in our own homes. Honesty and
          integrity are the most important pieces to our business and
          reputation.
        </p>
        <p>
          We're the largest retail AV showroom in central Pennsylvania with over
          12,000 square feet of product to play with. We offer in house design
          and installation by the area's best-certified installers and
          technicians. This means our knowledge pool is vast and ever expanding.
          Real experience on the products we sell equals real answers to the
          questions you pose.
        </p>
        <p class="header-2">Buying Power?</p>
        <img src="./project images/2.webp" alt="" />
        <p>
          HiDEF Lifestyle is honored to be recognized for the second year in a
          row as one of the fastest growing privately held retailers and
          businesses in the United States. This means we have the stock, buying
          power and leverage with our vendors to ensure we have the stock and
          prices to match or beat any authorized dealers offerings. Buy
          Authorized! This is imperative when investing in electronics. Rest
          assured that HiDEF Lifestyle is an authorized dealer for every single
          product we sell. Every product sold comes not only with our 30-day
          guarantee but also with the full manufacturer's warranty to ensure you
          and your investment are protected.
        </p>
      </div>

      <div class="footer">
        <p>Explore our social media for more details <a href="#">here</a></p>
      </div>
    </div>
    <div class="newsletter">
      <h1>Newsletter</h1>
      <p class="shout">
        A short sentence describing what someone will receive by subscribing
      </p>
      <input type="emal" required placeholder="Your email" />
      <a href="#"><button type="submit">Subscribe</button></a>
    </div>
    <?php include 'components/footer.php'; ?>
    <script src="js/script.js"></script>
  </body>

</html>
