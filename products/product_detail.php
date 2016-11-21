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

?>

<h1><?php echo $product_name ?></h1>
<div class="product-detail">
    <div>
        <img src="products/images/<?php echo $image_path ?>" alt="<?php echo $product_name ?>" class="product-image">
    </div>
    <div>
        <p class="description"><?php echo $product_desc ?></p>
    
        <p>Price:&nbsp;<?php echo $product_price ?></p>

        <?php

        if($product["Stock"] > 0) {
            echo <<<EOT
            <form action="shopping/cart.php" method="post" 
                id="add_to_cart_form">
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="product_id"
                        value="$product_id" />
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to Cart" />
            </form>
EOT;
        }
        else
        {
            echo "This item is currently out of stock.";
        }
        ?>
    
    </div>
</div>





