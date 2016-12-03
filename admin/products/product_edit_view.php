<?php include('server/view/header.php'); ?>

<!--this page is delivered by index.php-->
<h1>Edit Product</h1>

<p>Edit product information.</p>

<div class="form-wrapper">
    <form action="admin/products/index.php" method="post">

        <input type="hidden" name="action" value="update_product">
        
        <?php 
        
        include('server/view/error_messages.php');
        include('admin/products/product_edit_fields.php'); 
        
        ?>

        <button type="submit">Update</button>

    </form>
</div>


<div id="bottom-controls">
    <form action="admin/products/index.php" method="post">
        <input type="hidden" name="action" value="view_list">
        <button type="submit"><span class="fa fa-arrow-left"></span>&nbsp; Back To List</button>
    </form>
</div>

<?php include('server/view/footer.php'); ?>
