<!--this page is delivered by index.php-->
<h1>Login</h1>

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
    </div>

    <div>
    </div>

    <form action="account/index.php" method="post">
        <input type="hidden" name="action" value="view_register">
        <button type="submit">Register &nbsp;<span class="fa fa-arrow-right"></span></button>
    </form>
</div>