<!--this page is delivered by index.php-->
<h1>Your Credentials</h1>

<p>Enter new passwords to change</p>

<div class="form-wrapper">
    <form action="account/index.php" method="post">

        <input type="hidden" name="action" value="update_user">
        
        <?php 
        
        include('server/view/error_messages.php');
        include('account/user_edit_fields.php'); 
        
        ?>

        <button type="submit">Update</button>

    </form>
</div>

<div id="bottom-controls">
    <form action="account/index.php" method="post">
        <input type="hidden" name="action" value="view_profile">
        <button type="submit"><span class="fa fa-arrow-left"></span>&nbsp; Profile</button>
    </form>
</div>