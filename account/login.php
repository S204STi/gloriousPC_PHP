<h1>Login</h1>

<div class="form-wrapper">
    <form action="account/index.php" class="form" method="post">

        <input type="hidden" name="action" value="login_form">

        <div class="form-group">
        <label for="UserName">User Name:</label>
            <input type="text" name="UserName" required>
        </div>

        <div class="form-group">
        <label for="Password">Password:</label>
            <input type="text" name="Password" required>
        </div>

        <button type="submit">Login</button>
        
    </form>
    
</div>

<div id="bottom-controls">
    <form action="account/index.php" method="post">
        <input type="hidden" name="action" value="register">
        <button type="submit">Register</button>
    </form>
</div>