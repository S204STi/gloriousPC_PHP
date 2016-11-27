<div class="topbar">
  <a href="index.php" class="site-title">
    <div>
      <img src="server/src/images/site-img.png" alt="">
    </div>
    <div>
      <span class="gold">GLORIOUS</span> PC
    </div>
  </a>
  <div class="login">

    <p><a href="account/index.php">

    <?php 

      if (isset($_SESSION['user'])) {
        echo "Logout";
      } else {
        echo "Login";
      }
    ?>

      </a></p>
  </div>
</div>