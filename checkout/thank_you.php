<?php
// needed on all pages
require_once('../config.php');

// clear the cart to simulate purchase.
$_SESSION['cart'] = array();

include('server/view/header.php');

?>

<h1>Thank You</h1>

<p>We will send you a confirmation email shortly.</p>

<div id="bottom-controls">

        <div>
        </div>

        <div>
        </div>

        <div>
            <a href="index.php">
                <button>
                    Go Home &nbsp;<span class="fa fa-arrow-right"></span>
                </button>
            </a>
        </div>

    </div>

<?php include('server/view/footer.php'); ?>