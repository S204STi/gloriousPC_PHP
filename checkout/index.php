<?php
// needed on all pages
require_once('../config.php');
include('server/view/header.php');
?>

<h1>Checkout</h1>

<?php if(! isset($_SESSION['user'])){
    echo '<p>Please <a href="account/index.php">sign in</a> to continue.</p>';
} else {
    echo "<p>Enter payment information.</p>";
}
?>

<div id="bottom-controls">

        <div>
            <a href="cart/index.php">
                <button>
                    <span class="fa fa-arrow-left"></span>&nbsp; Cart 
                </button>
            </a>
        </div>

        <div>
        </div>

        <div>
            <a href="checkout/thank_you.php">
                <button>
                    Place Order &nbsp;<span class="fa fa-arrow-right"></span>
                </button>
            </a>
        </div>

    </div>

<?php include('server/view/footer.php'); ?>

