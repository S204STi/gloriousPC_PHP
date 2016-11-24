<?php
// Needed on all pages
require_once('../config.php');
include('server/view/header.php');

// Page dependencies
require_once('server/database/products.php');
require_once('server/database/categories.php');

$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

// If no category was requested, show all items
if ($category_id === NULL) {
        $product_ids = array(1, 2, 3);

        $products = array();

        foreach ($product_ids as $product_id) {
            $product = get_product($product_id);
            $products[] = $product;
        }
        ?>

        <h1>All Products</h1>
        <p>Select a category to narrow your search.</p>

        <?php

// Only show items from the requested category
} else {
    $products = get_products_by_category($category_id);

    $category = get_category($category_id);

    $category_name = $category["CategoryName"];

    echo "<h1>$category_name</h1>";
}

// product_card will show a card for each product in $products
require_once('products/product_card.php');

include('server/view/footer.php'); 
?>