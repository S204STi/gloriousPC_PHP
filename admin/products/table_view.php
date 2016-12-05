<?php 

include('server/view/header.php');

if(!empty($list_title)) {
    echo "<h1>$list_title</h1>";
}

if(!empty($list_description)) {
    echo "<p>$list_description</p>";
}

?>

<div class="text-right container-sm">
    <form action="admin/products/index.php" method="post">
        <input type="hidden" name="action" value="view_add">
        <div class="form-group">
            <button type="submit"><span class="fa fa-plus"></span>&nbsp; New</button>
        </div>
    </form>
</div>

<table class="table" cellspacing="0">
    <thead>
        <tr>
            <th class="text-left">Product</th>
            <th class="text-right">Price</th>
            <th class="text-right">Stock</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach($products as $product) { ?>

        <tr>
            <td class="text-left">
                <a href="admin/products/index.php?action=view_update&product_id=<?php echo $product['ProductId'] ?>">
                    <div>
                        <strong><?php echo htmlspecialchars($product['ProductName']); ?><strong>
                    </div>
                </a>
            </td>
            <td class="text-right">
                <a href="admin/products/index.php?action=view_update&product_id=<?php echo $product['ProductId'] ?>">
                    <div>
                        <?php echo $product['PriceEach'] ?>
                    </div>
                </a>
            </td>
            <td class="text-right">
                <a href="admin/products/index.php?action=view_update&product_id=<?php echo $product['ProductId'] ?>">
                    <div>
                        <?php echo $product['Stock'] ?>
                    </div>
                </a>
            </td>
        </tr>

        <?php } ?>

    </tbody>
</table>

<?php
include('server/view/footer.php'); 
?>