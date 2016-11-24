<?php  
// needed on all pages
require_once('config.php');
include('server/view/header.php');

// Page dependencies
require_once('server/database/products.php');
?>

<h1>Featured Products</h1>
<p>GLORIOUS PC stocks the best parts for all your computing needs!</p>

<?php 
$product_ids = array(1, 2, 3);

$products = array();

foreach ($product_ids as $product_id) {
    $product = get_product($product_id);
    $products[] = $product;
}

require_once('products/product_card.php');

include('server/view/footer.php'); 

?>