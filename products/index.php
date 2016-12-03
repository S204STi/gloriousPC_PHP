<?php
// Needed on all pages
require_once('../config.php');

// Page dependencies
require_once('server/database/products.php');
require_once('server/database/categories.php');

$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
$products = array();
$list_title = NULL;
$list_description = NULL;

// If no category was requested, show all items
if ($category_id === NULL) {
    $product_ids = array(1, 2, 3);

    foreach ($product_ids as $product_id) {
        $product = get_product($product_id);
        $products[] = $product;
    }
            
    $list_title = "All Products";
    $list_description = "Select a category to narrow your search.";

// Only show items from the requested category
} else {
    $products = get_products_by_category($category_id);

    $category = get_category($category_id);

    $category_name = $category["CategoryName"];
            
    $list_title = $category_name;
    $list_description = NULL;
}

// Show the table
include('products/list_view.php');
?>