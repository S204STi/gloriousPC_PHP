<?php
// needed on all pages
require_once('../config.php');

require_once('server/util/form.php');
require_once('server/database/customers.php');
require_once('server/database/users.php');

// Get all values this page might use, these can be used to remember user input between validation failures.
$NameOnCard = filter_input(INPUT_POST, 'NameOnCard');
$CardNumber = filter_input(INPUT_POST, 'CardNumber');
$ExpiryDate = filter_input(INPUT_POST, 'ExpiryDate');
$Ccv = filter_input(INPUT_POST, 'Ccv');

// new array for error messages.
$error_messages = array();

// Actions for this controller
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view';
        // If not logged in as customer, they must login
        if (!isset($_SESSION['user'])) {
            $action = 'signin_request';
        }
    }
}

// This switch controls what action the page is responding to
switch ($action) {

    // Place the order
    case 'confirm_checkout': 

        // Validate card
        // Forms validate the input, this form will validate payment data.
        $form = new Form();

        $form->text('NameOnCard', 'Name On Card', $NameOnCard);
        $form->cardNumber('CardNumber', 'Card Number', $CardNumber);
        $form->monthYear('ExpiryDate', 'Expiry Date', $ExpiryDate);
        $form->ccv('Ccv', 'CCV', $Ccv);

        $error_messages = $form->getErrorMessages();

        if(empty($error_messages)){
            
            // make address string
            $customer = get_customer_by_user_id($_SESSION['user']);
            $currentAddress = $customer['Address1'];

            // make order

            // clear the cart to simulate purchase.
            $_SESSION['cart'] = array();

            // Show the thank you
            include('checkout/thank_you_view.php');

        } else {

            // Failure, show the payment form again
            include('checkout/payment_view.php');
        }
        break;


    // The user isn't logged in as a customer
    case 'signin_request':

        include('checkout/signin_request_view.php');
        break;


    // Show the payment form
    case 'view':
    default:

        include('checkout/payment_view.php');
        break;

}
?>

