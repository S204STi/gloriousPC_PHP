<?php 
include('../view/header.php'); 

require_once('../server/main.php');
require_once('../server/database/products.php');
require_once('../view/product_card.php');

$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);

$product = get_product($product_id);

$product_name = htmlspecialchars($product['Name']);
$image_path = htmlspecialchars($product['ImagePath']);
$product_desc = htmlspecialchars($product['Description']);

$product_price = '$' . number_format($product['PriceEach'], 2);

if($product["Stock"] < 1) {
    $add_button = '<button class="disabled">Out of Stock</button>';
}
else 
{
    $add_button = '<button action="">Add to Cart</button>';
}


?>

<img src="products/images/<?php echo $image_path ?>" alt="<?php echo $product_name ?>">
<h1><?php echo $product_name ?></h1>
<p><?php echo $product_desc ?></p>
<p><?php echo $product_price ?></p>
<form action="shopping/cart.php" method="post" 
          id="add_to_cart_form">
    <input type="hidden" name="action" value="add" />
    <input type="hidden" name="product_id"
            value="<?php echo $product_id; ?>" />
    <b>Quantity:</b>&nbsp;
    <input type="text" name="quantity" value="1" size="2" />
    <input type="submit" value="Add to Cart" />
</form>
