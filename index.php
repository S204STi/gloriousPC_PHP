<?php 

include('view/header.php');

require_once('server/main.php');
require_once('server/database/products.php');
require_once('view/product_card.php');

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

foreach ($products as $product) {
    echo product_card($product);
}

include('view/footer.php'); 
?>