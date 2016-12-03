<?php include('server/view/header.php'); ?>

<!--this page is delivered by index.php-->
<h1>Sign up!</h1>

<p>Create a new account.</p>

<div class="form-wrapper">
    <form action="account/index.php" method="post">

        <input type="hidden" name="action" value="register">
        
        <?php 
        
        include('server/view/error_messages.php'); 
        include('account/user_edit_fields.php'); 
        include('account/profile_edit_fields.php');
        
        ?>

        <button type="submit">Register</button>

    </form>
</div>

<div id="bottom-controls">
    <form action="account/index.php" method="post">
        <button type="submit"><span class="fa fa-arrow-left"></span>&nbsp; Login</button>
    </form>
</div>

<?php include('server/view/footer.php'); ?>