<?php 

include('server/view/header.php');

if(!empty($list_title)) {
    echo "<h1>$list_title</h1>";
}

if(!empty($list_description)) {
    echo "<p>$list_description</p>";
}

echo get_product_cards($products);

include('server/view/footer.php'); 


// Accepts an array of products and creates html for the product cards.
function get_product_cards($products) {
    
    // Show cards for each product or a message if none available
    if(count($products) > 0) {
        foreach ($products as $product) {
            echo product_card($product);
        }
    } else {
        echo "<p>There doesn't seem to be anything here.</p>";
    }
}



// Accepts a product object and returns an html summary. Used a function to reduce I/O overhead of looped "includes"
function product_card($product) {

    if($product == NULL) {
        return;
    }

    $product_name = htmlspecialchars($product['ProductName']);
    $image_path = htmlspecialchars($product['ImagePath']);
    $product_id = $product["ProductId"];


    if($product["Stock"] < 1) {
        $product_price = "Out of Stock";
    }
    else
    {
        $product_price = '$' . number_format($product['PriceEach'], 2);
    }

    $htmlString = <<<HTML
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
HTML;

    return $htmlString;
}
?>