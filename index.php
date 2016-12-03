<?php  
// needed on all pages
require_once('config.php');

// Page dependencies
require_once('server/database/products.php');

$list_title = "Featured Products";
$list_description = "GLORIOUS PC stocks the best parts for all your computing needs!";

$product_ids = array(1, 3);

$products = array();

foreach ($product_ids as $product_id) {
    $product = get_product($product_id);
    $products[] = $product;
}

require_once('products/list_view.php');

?>