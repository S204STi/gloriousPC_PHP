<?php 
include('../view/header.php'); 
?>

<h1>Products</h1>
<p>Select a category to narrow your search.</p>

<?php

require_once('../server/main.php');
require_once('../server/database/products.php');
require_once('../view/product_card.php');

$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

if ($category_id === NULL) {
        $product_ids = array(1, 2, 3);

        $products = array();

        foreach ($product_ids as $product_id) {
            $product = get_product($product_id);
            $products[] = $product;
        }
        
} else {
    $products = get_products_by_category($category_id);
}

foreach ($products as $product) {
    echo product_card($product);
}

?>

<?php include('../view/footer.php'); ?>