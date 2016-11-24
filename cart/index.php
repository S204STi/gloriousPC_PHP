<?php
// needed on all pages
require_once('../config.php');

// Page dependencies
require_once('server/database/cart.php');
require_once('server/util/input_validation.php');

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
        } elseif (!is_valid_number($quantity, 1)) {
            display_error('Quantity must be 1 or more.');
        }

        cart_add_item($product_id, $quantity);
        $cart = cart_get_items();
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
        $cart = cart_get_items();
        break;

    default:
        
        // Get the cart to display it
        $cart = cart_get_items();
        break;
}

// Header had to be moved down so cart count was correct on load
include('server/view/header.php');

?>

<h1>Shopping Cart</h1>

<?php if (cart_product_count() == 0) : ?>
        <p>Your cart is empty.</p>
  <?php else: ?>
        <form action="cart/index.php" method="post" id="cart">
            <input type="hidden" name="action" value="update">
            <table class="cart-table">
            <tr>
                <th>Item</th>
                <th class="text-right">Price</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Total</th>
            </tr>
            <?php foreach ($cart as $product_id => $item) : ?>
            <tr>
                <td><a href="products/index.php?product_id=<?php echo $product_id ?>">
                    <?php echo htmlspecialchars($item['ProductName']); ?>
                    </a>
                </td>
                <td class="text-right">
                    <?php echo sprintf('$%.2f', $item['PriceEach']); ?>
                </td>
                <td class="text-right">
                    <input type="text" size="3" class="right"
                           name="items[<?php echo $product_id; ?>]"
                           value="<?php echo $item['Quantity']; ?>">
                </td>
                <td class="text-right">
                    <?php echo sprintf('$%.2f', $item['LinePrice']); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr id="cart-footer" >
                <td colspan="3" class="text-right" ><b>Subtotal</b></td>
                <td class="text-right">
                    <?php echo sprintf('$%.2f', cart_subtotal()); ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">
                    <input type="submit" value="Update Cart">
                </td>
            </tr>
            </table>
        </form>
        
    <?php endif; ?>

    <p>Return to: <a href="../">Home</a></p>

    <!-- display most recent category -->
    <?php if (isset($_SESSION['last_added']['CategoryId'])) :
            $category_url = 'products' .
                '?category_id=' . $_SESSION['last_added']['CategoryId'];
        ?>
        <p>Return to: <a href="<?php echo $category_url; ?>">
            <?php echo $_SESSION['last_added']['CategoryName']; ?></a></p>
    <?php endif; ?>

    <!-- if cart has items, display the Checkout link -->
    <?php if (cart_product_count() > 0) : ?>
        <p>
            Proceed to: <a href="checkout/index.php">Checkout</a>
        </p>
    <?php endif; ?>


<?php include('server/view/footer.php'); ?>

