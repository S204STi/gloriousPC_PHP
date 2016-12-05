<?php 
include("server/view/header.php");
?>

<h1>Success!</h1>
<p><?php echo $success_message ?></p>


<div id="bottom-controls">
    <a href="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <button type="submit"><span class="fa fa-arrow-left"></span>&nbsp; Back to List</button>
    </a>
</div>

<?php
include("server/view/footer.php");
?>