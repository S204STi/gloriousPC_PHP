<ul>
  <li>
    <a href="products/index.php">Products</a>
    <ul>

      <?php
        $categories = get_all_categories();

        foreach($categories as $category) :
        $category_name = $category['Name'];
        $category_id = $category['Id'];
        ?>

            <li>
            <a href="products/index.php?category_id=<?php echo $category_id; ?>">
                <?php echo $category_name; ?>
            </a>
            </li>

        <?php endforeach; ?>

    </ul>
  </li>
  <li>
    <a href="account/profile.php">Account</a>
    <ul>
      <li>
        <a href="account/profile.php">Profile</a>
      </li>
      <li>
        <a href="account/orders.php">Orders</a>
      </li>
    </ul>
  </li>
  <li>
    <a href="admin/products.php">Admin</a>
    <ul>
      <li>
        <a href="admin/products.php">Products</a>
      </li>
      <li>
        <a href="admin/customers.php">Customers</a>
      </li>
      <li>
        <a href="admin/orders.php">Orders</a>
      </li>
    </ul>
  </li>
  <li>
    <a href="shopping/cart.php"><span class="fa fa-shopping-cart"></span> Cart</a>
  </li>
</ul>