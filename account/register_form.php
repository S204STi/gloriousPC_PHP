<!--this page is delivered by index.php-->
<h1>Sign up!</h1>

<div class="form-wrapper">
    <form action="account/index.php" method="post">

        <input type="hidden" name="action" value="register">
        
        <?php include('server/view/error_messages.php'); ?>

        <div class="form-group">
            <label for="UserName">User Name:</label>
            <input type="text" name="UserName" value="<?php echo htmlspecialchars($UserName) ?>">
        </div>

        <?php include('account/customer_edit_form.php'); ?>

        <button type="submit">Register</button>

    </form>
</div>

<div id="bottom-controls">
    <form action="account/index.php" method="post">
        <button type="submit">Login</button>
    </form>
</div>