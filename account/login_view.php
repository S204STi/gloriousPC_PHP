<?php include('server/view/header.php'); ?>

<!--this page is delivered by index.php-->
<h1>Login</h1>

<p>Enter your user name and password.</p>

<div class="form-wrapper">
    <form action="account/index.php" method="post">

        <input type="hidden" name="action" value="login">

        <?php 
        
        include('server/view/error_messages.php'); 
        include('account/login_fields.php'); 
        
        ?>

        <button type="submit">Login</button>
        
    </form>
    
</div>

<div id="bottom-controls">

    <div>
    <!-- This div intentionally left blank -->
    </div>

    <div>
    <!-- This div intentionally left blank -->
    </div>

    <form action="account/index.php" method="post">
        <input type="hidden" name="action" value="view_register">
        <button type="submit">Register &nbsp;<span class="fa fa-arrow-right"></span></button>
    </form>
</div>
<?php include('server/view/footer.php'); ?>