<?php  
// needed on all pages
require_once('config.php');

// Page dependencies
require_once('server/database/products.php');

$list_title = "Featured Products";
$list_description = "GLORIOUS PC stocks the best parts for all your computing needs!";

$products = get_featured_products();

require_once('products/list_view.php');
?>