<?php include('server/view/header.php'); ?>

<!--this page is delivered by index.php-->
<h1>Add New Category</h1>

<p>Enter all the category information.</p>

<div class="form-wrapper">
    <form action="admin/categories/index.php" name="add_category" method="post">

        <input type="hidden" name="action" value="add_category">
        
        <?php 
        include('server/view/error_messages.php');
        include('admin/categories/category_edit_fields.php'); 
        ?>

        <button type="submit">Add</button>

    </form>
</div>


<div id="bottom-controls">
    <form action="admin/categories/index.php" method="post">
        <input type="hidden" name="action" value="view_list">
        <button type="submit"><span class="fa fa-arrow-left"></span>&nbsp; Back To List</button>
    </form>

    <div>
    </div>
</div>

<?php include('server/view/footer.php'); ?>
