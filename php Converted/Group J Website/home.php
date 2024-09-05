<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="./css/home.css" />
    <script
      src="https://kit.fontawesome.com/6f47df0af3.js"
      crossorigin="anonymous"
    ></script>
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="hero">
        <div class="container">
            <div class="hero-content">
              <h1 class="hero-title">Introducing: the Headphones Collection</h1>
              <p class="hero-subtitle">Discover our selection of the best headphones of the year</p>
              <button class="hero-btn">Shop Now</button>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="header-tiles">
          <div class="header-tile 1" style="background-color: #fc2a68;">
          <h2>OLED TVs</h2>
          <p>Exclusive offers on TVs until Dec 31.
            $100 off on every purchase</p>
          <a href="shop.php"><button type="submit" style="color: #fc2a68;">Shop Now</button></a>
          </div>
          <div class="header-tile 2" style="background-color: #6f42ef;">
          <h2>Speakers</h2>
          <p>Explore our range of high-quality speakers.</p>
          <a href="shop.php"><button type="submit" style="color: #6f42ef;">Shop Now</button></a>
          </div>
          <div class="header-tile 3" style="background-color: #00badb;">
          <h2>Headphones</h2>
          <p>Discover our new headphones.
            Up to 25% Off !</p>
          <a href="shop.php"><button type="submit" style="color: #00badb;">Shop Now</button></a>
          </div>
        </div>
      </section>
      <section>
        <div class="banner-tiles">
          <div class="banner-tile 1">
            <img src="./images/labeling.png" alt="">
            <h3>Exclusive offers on every products</h3>
            <p>We offer you a lot of discounts on all our JLB speakers, including JBL Clip 3, JBL Flip 4 or JBL Link 20 !</p>
          </div>
          <div class="banner-tile 2">
            <img src="./images/shipment.png" alt="">
            <h3>Free shipping for all orders overs $80</h3>
            <p>We got you covered ! We deliver your goods using UPS expedited shipping, free of charge</p>
          </div>
        </div>
      </section>
      <section>
        <div class="media-with-text">
          <div class="text">
            <h2>Setup your Surround sound speaker</h2>
            <p>I will make the assumption that you have a surround sound or home theater receiver and start from there. If you have speaker level binding post inputs, these are almost always for using the sub-woofer in a non surround sound speaker setup.</p>
          </div>
        </div>
      </section>
      <section>
        <div class="categories">
          <h2>Most Searched Collections</h2>
          <div class="brands">
            <div class="tile">Headphones</div>
            <div class="tile">Speakers</div>
            <div class="tile">TVs</div>
            <div class="tile">Turnables</div>
            <div class="tile">Subwoofers</div>
            <div class="tile">Projectors</div>
          </div>
        </div>
      </section>
      <section>
        <div class="all">
          <h1 class="header-1">New Arrivels</h1>
          <div class="tiles">
          <?php
            $select_products = $conn->prepare("SELECT * FROM `products`"); 
            $select_products->execute();
            if($select_products->rowCount() > 0){
               while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
          ?>
            <div class="tile 1">
            <form action="" method="post">
               <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
              <span><button type="submit" name="add_to_wishlist" class="icon"><i class="fa-solid fa-heart"></i></button></span>
              <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
              <h5 style="color: gray;">WAREHOUSE</h5>
              <h4><?= $fetch_product['name']; ?></h4>
              <p class="price"><span>LKR </span><?= $fetch_product['price']; ?><span>/=</span></p>
              <div class="sq">
                <p class="stock">In Stock</p>
                <input type="number" name="qty" class="qty" min="1" max="30" onkeypress="if(this.value.length == 2) return false;" value="1">
              </div>
              <input type="submit" value="Add To Cart" class="btn_1" name="add_to_cart">
              <div class="link"><a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="btn_2">Buy Now</a></div>
            </form>
          </div>
          <?php
               }
            }else{
               echo '<p class="empty">no products found!</p>';
            }
          ?>
      </div>
      </section>
      <section>
        <div class="categories">
          <h2>Our Brands</h2>
          <div class="brands">
            <div class="tile"><img src="./images/b1.avif" alt=""></div>
            <div class="tile"><img src="./images/b2.avif" alt=""></div>
            <div class="tile"><img src="./images/b3.avif" alt=""></div>
            <div class="tile"><img src="./images/b4.avif" alt=""></div>
            <div class="tile"><img src="./images/b5.avif" alt=""></div>
            <div class="tile"><img src="./images/b6.avif" alt=""></div>
          </div>
        </div>
      </section>

      <section>
        <div class="map">
          <div class="map-tile">
            <div class="content">
              <h2 style="color: #1e2d7d;">HiDEF Lifestyle Home Theater Store</h2>
              <h4>6195 Allentown Blvd, Harrisburg, PA 17112, USA</h4>
              <p>Monday - Friday: 9AM - 7PM</p>
              <p>Saturday: 9AM - 5PM
              </p>
              <p>Sunday: Closed</p>
              <a href="contact.php"><button>Contact Us</button></a>
            </div>
          </div>
          <div class="image"><img src="./images/map.webp" alt=""></div>
        </div>
      </section>

      <section>
        <div class="all">
          <h1 class="header-1">Latest Collection</h1>
          <div class="tiles">
          <?php
            $select_products = $conn->prepare("SELECT * FROM `products`"); 
            $select_products->execute();
            if($select_products->rowCount() > 0){
               while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
          ?>
            <div class="tile 1">
            <form action="" method="post">
               <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
              <span><button type="submit" name="add_to_wishlist" class="icon"><i class="fa-solid fa-heart"></i></button></span>
              <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
              <h5 style="color: gray;">WAREHOUSE</h5>
              <h4><?= $fetch_product['name']; ?></h4>
              <p class="price"><span>LKR </span><?= $fetch_product['price']; ?><span>/=</span></p>
              <div class="sq">
                <p class="stock">In Stock</p>
                <input type="number" name="qty" class="qty" min="1" max="30" onkeypress="if(this.value.length == 2) return false;" value="1">
              </div>
              <input type="submit" value="Add To Cart" class="btn_1" name="add_to_cart">
              <div class="link"><a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="btn_2">Buy Now</a></div>
            </form>
          </div>
          <?php
               }
            }else{
               echo '<p class="empty">no products found!</p>';
            }
          ?>
      </div>
      </section>

<section>
        <div class="touch">
          <div class="newsletter">
          <h1>Let's keep in touch!
          </h1>
          <p class="shout">
            Subscribe to our weekly newsletter and receive exclusive offers on products you love!
          </p>
          <input type="emal" required placeholder="Your email" />
          <a href="#"><button type="submit">Subscribe</button></a>
                </div>
        </div>
</section>

   <script src="js/script.js"></script>

<?php include 'components/footer.php'; ?>


</body>
</html>