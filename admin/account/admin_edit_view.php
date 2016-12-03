<?php include('server/view/header.php'); ?>

<!--this page is delivered by index.php-->
<h1>Admin Credentials</h1>

<p>Change the administrator user name and password.</p>

<div class="form-wrapper">
    <form action="admin/account/index.php" method="post">

        <input type="hidden" name="action" value="update_admin">
        
        <?php 
        
        include('server/view/error_messages.php');
        include('account/user_edit_fields.php'); 
        
        ?>

        <button type="submit">Update</button>

    </form>
</div>

<?php include('server/view/footer.php'); ?>