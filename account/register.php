<h1>Sign up!</h1>

<div class="form-wrapper">
    <form action="account/index.php" class="form" method="post">
        <input type="hidden" name="action" value="register">

        <?php 

        include('account/customer_edit.php');

        ?>
    </form>
</div>

<div id="bottom-controls">
    <form action="account/index.php" method="post">
        <button type="submit">Login</button>
    </form>
</div>