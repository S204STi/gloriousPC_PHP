<?php include('server/view/header.php'); ?>

<h1>Shopping Cart</h1>

<?php if (cart_product_count() == 0) : ?>
        <p>Your cart is empty.</p>
  <?php else: ?>
        <form action="cart/index.php" method="post" id="cart-table">
            <input type="hidden" name="action" value="update">
            <table class="table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-left">Item</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $product_id => $item) : ?>
                    <tr>
                        <td>
                            <a href="products/product_detail.php?product_id=<?php echo $product_id ?>">
                                <div>
                                    <strong><?php echo htmlspecialchars($item['ProductName']); ?><strong>
                                </div>
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="products/product_detail.php?product_id=<?php echo $product_id ?>">
                                <div>
                                    <?php echo sprintf('$%.2f', $item['PriceEach']); ?>
                                </div>
                            </a>
                        </td>
                        <td class="text-right">
                            <input type="text" class="text-right small"
                                name="items[<?php echo $product_id; ?>]"
                                value="<?php echo $item['Quantity']; ?>">
                        </td>
                        <td class="text-right">
                            <?php echo sprintf('$%.2f', $item['LinePrice']); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
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
                <tfoot>
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
    