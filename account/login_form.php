<!--this page is delivered by index.php-->
<h1>Login</h1>

<div class="form-wrapper">
    <form action="account/index.php" method="post">

        <input type="hidden" name="action" value="login">

        <?php include('server/view/error_messages.php'); ?>

        <div class="form-group">
        <label for="UserName">User Name:</label>
            <input type="text" name="UserName" value="<?php echo htmlspecialchars($UserName) ?>">
        </div>

        <div class="form-group">
        <label for="Password">Password:</label>
            <input type="text" name="Password">
        </div>

        <button type="submit">Login</button>
        
    </form>
    
</div>

<div id="bottom-controls">
    <form action="account/index.php" method="post">
        <input type="hidden" name="action" value="view_register">
        <button type="submit">Register</button>
    </form>
</div>