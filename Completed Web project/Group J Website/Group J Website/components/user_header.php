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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="css/user_header.css" />
    <script src="https://kit.fontawesome.com/6f47df0af3.js" crossorigin="anonymous"></script>
  </head>
  <body class="body">
    <header>
      <div class="announsment-bar">
        <div class="uhtop-bar">
          <div class="uhshipping-info">
            <p>Free shipping on orders over LKR 25,000</p>
          </div>
        </div>
      </div>

      <div class="uhnav-bar">
        <a href="home.php" class="uh-logo">
          <img class="uh-header-logo" src="images/Logo.webp" alt="logo" />
        </a>
        <ul class="uh-ul">
          <li><a href="home.php">Home</a></li>
          <li><a href="shop.php">All Products</a></li>
          <li><a href="orders.php">Orders</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="faq.php">FAQs</a></li>
          <li><a href="meet_the_team.php">Meet Our Team</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>

        <div class="uh-icons">
            <?php
                $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $count_wishlist_items->execute([$user_id]);
                $total_wishlist_counts = $count_wishlist_items->rowCount();

                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                $total_cart_counts = $count_cart_items->rowCount();
            ?>
           

            <span class="uh-icons-cart">
                <a href="search_page.php">
                <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </span>
            <span class="uh-icons-cart">
                <a href="wishlist.php">
                <i class="fa-regular fa-heart"></i>
                </a>
            </span>
            <span class="uh-icons-cart">
                <a href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </span>
 
          <div class="uh-user-menu">
            <div class="uh-profile-icon">
              <span class="icons-cart"><i class="fa-solid fa-user"></i></span>
            </div>
            <div class="uh-dropdown">
              <?php
                
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
               if($select_profile->rowCount() > 0){
                 $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
              ?>
              <p class="uh-user-role"><?= $fetch_profile["name"]; ?></p>

              
              <button class="uh-btn update-profile" onclick="location.href='update_user.php'">Update Profile</button>

              <!-- <button class="uh-btn register" onclick="location.href='user_register.php'">Register</button>
              <button class="uh-btn login" onclick="location.href='user_login.php'">Login</button> -->
              <button class="uh-btn logout" onclick="if(confirm('Logout from the website?')) { location.href='components/user_logout.php'; }">Logout</button>

              <?php
               }else{
              ?>
              <p>please login or register first!</p>
              <button class="uh-btn register" onclick="location.href='user_register.php'">Register</button>
              <button class="uh-btn login" onclick="location.href='user_login.php'">Login</button>
              <?php }
              ?>
            </div>
          </div>
        </div>
      </div>
    </header>

    <script> // Toggle dropdown visibility on profile icon click
    document.querySelector('.uh-profile-icon').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent click event from bubbling up
        const dropdown = document.querySelector('.uh-dropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Close dropdown when clicking outside of user menu
    document.addEventListener('click', function(event) {
        const userMenu = document.querySelector('.uh-user-menu');
        const dropdown = document.querySelector('.uh-dropdown');

        // Check if the click is outside the user menu
        if (!userMenu.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });</script>
  </body>
</html>
