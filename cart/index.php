<?php
// needed on all pages
require_once('../config.php');

// Page dependencies
require_once('cart/cart.php');


// Check for get or post actions being called
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view';
    }
}

// perform the action requested
switch ($action) {

    case 'add':

        // Add an item to the cart
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity');

        // validate the quantity entry
        if ($quantity === null) {
            display_error('You must enter a quantity.');
        } elseif (!is_numeric(round($quantity, 0))) {
            display_error('Quantity must be 1 or more.');
        }

        cart_add_item($product_id, $quantity);
        break;

    case 'update':

        // Change the quantity
        $items = filter_input(INPUT_POST, 'items', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        foreach ( $items as $product_id => $quantity ) {
            if ($quantity == 0) {
                cart_remove_item($product_id);
            } else {
                cart_update_item($product_id, $quantity);
            }
        }
        break;

    case 'clear':

        // Clear the cart
        clear_cart();
        break;

    case 'view':
    default:
        break;
}

// Show the cart
$cart = cart_get_items();
include('cart/cart_view.php');
?>

