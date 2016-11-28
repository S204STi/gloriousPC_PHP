<?php
require_once('server/database/products.php');

// Cart is stored in session data in server memory. The database is needed to query product information.

// Create an empty cart if it doesn't exist
if (!isset($_SESSION['cart']) ) {
    $_SESSION['cart'] = array();
}

// Add an item to the cart
function cart_add_item($product_id, $quantity) {

    if(! isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = 0;
    }

    // Add the quantity of the item to the cart
    $_SESSION['cart'][$product_id] += round($quantity, 0);

    // Set last added for back urls
    $_SESSION['last_added'] = get_product($product_id);
}

// Update an item in the cart
function cart_update_item($product_id, $quantity) {

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = round($quantity, 0);
    }
}

// Remove an item from the cart
function cart_remove_item($product_id) {

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Get an array of items for the cart
function cart_get_items() {

    $items = array();

    foreach ($_SESSION['cart'] as $product_id => $quantity ) {
        // Get product data from db
        $product = get_product($product_id);
        $quantity = intval($quantity);
        $price = $product['PriceEach'];

        // Calculate the price of the line
        $line_price = round($price * $quantity, 2);

        // Store data in items array
        $items[$product_id] = $product;
        $items[$product_id]['Quantity'] = intval($quantity);
        $items[$product_id]['LinePrice'] = $line_price;
    }
    return $items;
}

// Get the number of products in the cart
function cart_product_count() {

    return count($_SESSION['cart']);
}

// Get the number of items in the cart
function cart_item_count () {

    $count = array_sum($_SESSION['cart']);
    return $count;
}

// Get the subtotal for the cart
function cart_subtotal () {
    $subtotal = 0;
    $cart = cart_get_items();
    foreach ($cart as $item) {
        $subtotal += $item['LinePrice'];
    }
    return $subtotal;
}

// Remove all items from the cart
function clear_cart() {
    
    $_SESSION['cart'] = array();
}
?>