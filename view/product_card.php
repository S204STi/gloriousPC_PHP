<?php

// Accepts a product object and returns an html summary.
function product_card($product) {

    if($product == NULL) {
        return;
    }

    $product_name = htmlspecialchars($product['Name']);
    $image_path = htmlspecialchars($product['ImagePath']);
    $product_id = $product["Id"];


    if($product["Stock"] < 1) {
        $product_price = "Out of Stock";
    }
    else
    {
        $product_price = '$' . number_format($product['PriceEach'], 2);
    }


    $htmlString = <<<EOT
    <a href="products/product_detail.php?product_id=$product_id">
        <div class="product-card">
            <div>
                <img src="products/images/$image_path" alt="$product_name">
            </div>
            <div>
                <h2>$product_name</h2>
                <h2 class="price">$product_price</h2>
            </div>
        </div>
    </a>
EOT;

    return $htmlString;
}
?>
