<?php include('server/view/header.php'); ?>

<!--this page is delivered by index.php-->
<h1>Your Profile</h1>

<p>Change your profile information.</p>

<div class="form-wrapper">
    <form action="account/index.php" method="post">

        <input type="hidden" name="action" value="update_profile">
        
        <?php 
        
        include('server/view/error_messages.php');
        include('account/profile_edit_fields.php'); 
        
        ?>

        <button type="submit">Update</button>

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
        <input type="hidden" name="action" value="view_user">
        <button type="submit">Credentials &nbsp;<span class="fa fa-arrow-right"></span></button>
    </form>
</div>

<?php include('server/view/footer.php'); ?>
