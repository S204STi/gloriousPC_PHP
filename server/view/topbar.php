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
      <a href="account/login.php?action=logout" class="purple">Logout</a>
HTML;
      } else {

        echo <<<HTML
      <a href="account/login.php" class="purple">Login</a>
HTML;
      }
      ?>
      
  </div>
</div>