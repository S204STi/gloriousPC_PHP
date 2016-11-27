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

    <?php 
      if (isset($_SESSION['user'])) {
        echo <<<HTML
      <p><a href="account/login.php?action=logout">Logout</a></p>
HTML;
      } else {

        echo <<<HTML
      <p><a href="account/login.php">Login</a></p>
HTML;
      }
      ?>
      
  </div>
</div>