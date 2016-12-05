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
    <form action="admin/categories/index.php" method="post">
        <input type="hidden" name="action" value="view_add">
        <div class="form-group">
            <button type="submit"><span class="fa fa-plus"></span>&nbsp; New</button>
        </div>
    </form>
</div>

<table class="table" cellspacing="0">
    <thead>
        <tr>
            <th class="text-left">Category</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach($categories as $category) { ?>

        <tr>
            <td class="text-left">
                <a href="admin/categories/index.php?action=view_update&category_id=<?php echo $category['CategoryId'] ?>">
                    <div>
                        <strong><?php echo htmlspecialchars($category['CategoryName']); ?><strong>
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