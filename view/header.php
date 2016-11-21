<!DOCTYPE html>
<html>

<head>
  <title>GLORIOUS PC</title>
  <meta charset="UTF-8">
  <meta name="description" content="Buy Personal Computer Parts">
  <meta name="keywords" content="Keyboards, GPU, Graphic Cards, Video Cards, PC, Computer, Repair, Parts">
  <meta name="author" content="Jeff Schreiner">

  <base href="http://localhost/glorious/">
  <link rel="apple-touch-icon" sizes="180x180" href="src/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="src/images/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="src/images/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="src/images/manifest.json">
  <link rel="shortcut icon" href="src/images/favicon.ico">
  <meta name="msapplication-config" content="src/images/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <link rel="stylesheet" href="src/css/font-awesome.min.css">
  <link rel="stylesheet" href="src/css/site.css">

</head>

<body>
  <header>
    <!--Page Container keeps the site from getting too wide-->
    <div class="container">
      <div class="topbar">
        <a href="index.php" class="site-title">
          <div>
            <img src="src/images/site-img.png" alt="">
          </div>
          <div>
            <span class="gold">GLORIOUS</span> PC
          </div>
        </a>
        <div class="login">
          <a href="account/login.php" class="purple">Login</a> / <a href="account/signup.php" class="purple">Signup</a>
          <!--<a href="account/logout.php" class="purple">Logout</a>-->
        </div>
      </div>
    </div>

	<!--Navigation Bar-->
    <nav>
      <div class="container">
        <ul>
          <li>
            <a href="products/index.php">Products</a>
            <ul>

              <?php
                require_once('../server/main.php');
                require_once('../server/database/categories.php');

                $categories = get_all_categories();
                foreach($categories as $category) :
                  $category_name = $category['Name'];
                  $category_id = $category['Id'];
              ?>

              <li>
                <a href="products/index.php?category_id=<?php echo $category_id; ?>"><?php echo $category_name; ?></a>
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
      </div>
    </nav>
  </header>

  <main>
    <div class="container content">