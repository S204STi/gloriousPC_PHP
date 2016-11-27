<ul>
  <li>
    <a href="products/index.php">Products</a>
    <ul>

      <?php

        require_once('server/database/categories.php');
        require_once('server/database/cart.php');

        // Dynamically create the product menu with an item for each category that exists in the db
        $categories = get_all_categories();

        foreach($categories as $category) {
          $category_name = htmlspecialchars($category['CategoryName']);
          $category_id = htmlspecialchars($category['CategoryId']);

        echo <<<HTML
          <li><a href="products/index.php?category_id=$category_id">$category_name</a></li>
HTML;
        }
      ?>

    </ul>
  </li>
  
  <?php 

    if (isset($_SESSION['admin'])) {

      include("server/view/navbar-admin.php");

    } else {

      if (isset($_SESSION['user'])) {

        include("server/view/navbar-admin.php");

      }
    }
?>


  <li id="cart">
    <a href="cart/index.php"><span class="fa fa-shopping-cart"></span> Cart (<?php echo cart_item_count() ?>)</a>
  </li>
</ul>