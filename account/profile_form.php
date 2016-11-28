<!--this page is delivered by index.php-->
<h1>Your Profile</h1>

<div class="form-wrapper">
    <form action="account/index.php" method="post">

        <input type="hidden" name="action" value="update_account">
        
        <?php include('server/view/error_messages.php'); ?>

        <?php include('account/customer_edit_form.php'); ?>

        <button type="submit">Update</button>

    </form>
</div>