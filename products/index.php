<?php
// Needed on all pages
require_once('../config.php');
include(APP_ROOT . 'view/header.php');

// Page dependencies
require_once(APP_ROOT . 'server/database/products.php');
require_once(APP_ROOT . 'view/product_card.php');
require_once(APP_ROOT . 'server/database/categories.php');

$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

if ($category_id === NULL) {
        $product_ids = array(1, 2, 3);

        $products = array();

        foreach ($product_ids as $product_id) {
            $product = get_product($product_id);
            $products[] = $product;
        }
        ?>

        <h1>Products</h1>
        <p>Select a category to narrow your search.</p>

        <?php
} else {
    $products = get_products_by_category($category_id);

    $category = get_category($category_id);

    $category_name = $category["Name"];

    echo "<h1>All $category_name</h1>";
}

if(count($products) > 0) {
    foreach ($products as $product) {
        echo product_card($product);
    }
} else {
    echo "<p>There doesn't seem to be anything here.</p>";
}

?>

<?php include('../view/footer.php'); ?>