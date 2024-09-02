<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

include 'components/wishlist_cart.php';

if(isset($_POST['delete'])){
   $wishlist_id = $_POST['wishlist_id'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
   $delete_wishlist_item->execute([$wishlist_id]);
}

if(isset($_GET['delete_all'])){
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Wishlist</title>
    <link rel="stylesheet" href="./css/wishlist.css" />
  </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="Dashboard">
      <h1 class="header-1">Your Wishlist</h1>
      <div class="all">
          <div class="tiles">
            <?php
               $grand_total = 0;
               $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
               $select_wishlist->execute([$user_id]);
               if($select_wishlist->rowCount() > 0){
                  while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
                     $grand_total += $fetch_wishlist['price'];  
            ?>
            <div class="tile 1">
            <form action="" method="post">
               <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
               <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">
               <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
              <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
              <h5 style="color: gray;">WAREHOUSE</h5>
              <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?> "style="text-decoration-line:none;">
                 <h4><?= $fetch_wishlist['name']; ?></h4>
              </a>
              <p class="price">LKR <?= $fetch_wishlist['price']; ?>/=</p>
              <div class="sq">
                <p class="stock">In Stock</p>
                <input type="number" name="qty" class="qty" min="1" max="30" onkeypress="if(this.value.length == 2) return false;" value="1">
              </div>
              <input type="submit" value="Add To Cart" class="btn" name="add_to_cart" style="background-color: #31c6e1; margin-top: 30px;">
              <input type="submit" value="Delete Item" onclick="return confirm('delete this from wishlist?');" class="btn" name="delete">
            </form>
          </div>
            <?php
               }
            }else{
               echo '<p class="empty">Your Wishlist Is Empty</p>';
            }
            ?>
        </div>
        <div class="check_tile">
          <div class="check">
              <h2>Grand Total: <span>LKR <?= $grand_total; ?>/=</span></h2>
              <div><a href="shop.php"><button style="background-color: #31c6e1" class="btn">Continue Shopping</button></a></div>
              <div><a href="wishlist.php?delete_all" <?= ($grand_total > 1)?'':'disabled'; ?> onclick="return confirm('delete all from wishlist?');"><button class="btn">Delete Items</button></a></div>
          </div>
        </div>
    </div>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>