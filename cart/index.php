<?php
// needed on all pages
require_once('../config.php');

// Page dependencies
require_once('server/database/cart.php');

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

    case 'clear':

        // Clear the cart
        clear_cart();
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
        <form action="cart/index.php" method="post" id="cart-table">
            <input type="hidden" name="action" value="update">
            <table class="cart-table" cellspacing="0">
            <tr>
                <th class="text-left"></th>
                <th class="text-right">Price</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Total</th>
            </tr>
            <?php foreach ($cart as $product_id => $item) : ?>
            <tr>
                <td>
                    <a href="products/index.php?product_id=<?php echo $product_id ?>">
                        <div>
                            <strong><?php echo htmlspecialchars($item['ProductName']); ?><strong>
                        </div>
                    </a>
                </td>
                <td class="text-right">
                    <?php echo sprintf('$%.2f', $item['PriceEach']); ?>
                </td>
                <td class="text-right qty-col">
                    <input type="text" class="text-right"
                           name="items[<?php echo $product_id; ?>]"
                           value="<?php echo $item['Quantity']; ?>">
                </td>
                <td class="text-right">
                    <?php echo sprintf('$%.2f', $item['LinePrice']); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr id="cart-table-footer" >
                <td colspan="3" class="text-right loud" ><b>Subtotal</b></td>
                <td class="text-right gold loud"><strong>
                    <?php echo sprintf('$%.2f', cart_subtotal()); ?>
                </strong></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">
                    <button type="submit" >Update Cart</button>
                </td>
            </tr>
            </table>
        </form>
        
    <?php endif; ?>

    <div id="bottom-controls">

    <!-- display most recent category -->
    <?php if (isset($_SESSION['last_added']['CategoryId'])) :
            $category_url = 'products' .
                '?category_id=' . $_SESSION['last_added']['CategoryId'];
        ?>
        <div><a href="<?php echo $category_url; ?>">
            <button>
                <span class="fa fa-arrow-left"></span>&nbsp; <?php echo $_SESSION['last_added']['CategoryName']; ?>
            </button>
        </a></div>
    <?php endif; ?>

    <!-- if cart has items, display the Checkout link -->
    <?php if (cart_product_count() > 0) : ?>

        <div>
            <a href="cart/index.php?action=clear">
                <button>
                    Empty Cart
                </button>
            </a>
        </div>

        <div>
            <a href="checkout/index.php">
                <button>
                    Checkout &nbsp;<span class="fa fa-arrow-right"></span>
                </button>
            </a>
        </div>
    <?php endif; ?>

    </div>

<?php include('server/view/footer.php'); ?>

