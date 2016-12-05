<?php include('server/view/header.php'); ?>

<!--this page is delivered by index.php-->
<h1>Edit Category</h1>

<p>Edit category information.</p>

<div class="form-wrapper">
    <form action="admin/categories/index.php" name="update_category" method="post">

        <input type="hidden" name="action" value="update_category">
        <input type="hidden" name="CategoryId" value="<?php echo $CategoryId ?>">
        
        <?php 
        
        include('server/view/error_messages.php');
        include('admin/categories/category_edit_fields.php'); 
        
        ?>

        <button type="submit">Update</button>

    </form>
</div>


<div id="bottom-controls">
    <form action="admin/categories/index.php" method="post">
        <input type="hidden" name="action" value="view_list">
        <button type="submit"><span class="fa fa-arrow-left"></span>&nbsp; Back To List</button>
    </form>

    <form action="admin/categories/index.php" method="post">
        <input type="hidden" name="action" value="delete_category">
        <input type="hidden" name="CategoryId" value="<?php echo $CategoryId ?>">
        <button type="submit"><span class="fa fa-times"></span>&nbsp; Delete Category</button>
    </form>

    <div>
    </div>
</div>

<?php include('server/view/footer.php'); ?>
