<?php include('server/view/header.php'); ?>

<h1>Checkout</h1>

<p>Your order will ship to your current address.</p>

<div class="form-wrapper">
    <form action="checkout/index.php" method="post">

        <input type="hidden" name="action" value="confirm_checkout">

        <?php include('server/view/error_messages.php'); ?> 
        
        <div class="form-group">
            <label for="NameOnCard">Name on Card:</label>
            <input type="text" name="NameOnCard" value="<?php echo htmlspecialchars($NameOnCard) ?>">
        </div>

        <div class="form-group">
            <label for="CardNumber">Card Number:</label>
            <input type="text" name="CardNumber" value="<?php echo htmlspecialchars($CardNumber) ?>" placeholder="xxxx-xxxx-xxxx-xxxx">
        </div>

        <div class="form-group">
            <label for="ExpiryDate">Expiry Date:</label>
            <input type="text" name="ExpiryDate" value="<?php echo htmlspecialchars($ExpiryDate) ?>" placeholder="MM/YYYY">
        </div>

        <div class="form-group">
            <label for="Ccv">CCV:</label>
            <input type="text" name="Ccv" value="<?php echo htmlspecialchars($Ccv) ?>" placeholder="xxx">
        </div>

        <button type="submit">Place Order</button>
        
    </form>
    
</div>

<div id="bottom-controls">

    <div>
        <a href="cart/index.php">
            <button>
                <span class="fa fa-arrow-left"></span>&nbsp; Cart 
            </button>
        </a>
    </div>

</div>
<?php include('server/view/footer.php'); ?>