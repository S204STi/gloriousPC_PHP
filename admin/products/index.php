<?php
// needed on all pages
require_once('../../config.php');

require_once('server/util/form.php');
require_once('server/database/products.php');
require_once('server/database/categories.php');

// authenticate that they are admin, if not then show forbidden page
if (!isset($_SESSION['admin'])) {
    forbidden();
}

// Get all values this page might use, these can be used to remember user input between validation failures.
$ProductId = filter_input(INPUT_GET, 'ProductId');
$ProductName = filter_input(INPUT_POST, 'ProductName');
$Description = filter_input(INPUT_POST, 'Description');
$Stock = filter_input(INPUT_POST, 'Stock');
$PriceEach = filter_input(INPUT_POST, 'PriceEach');
$ImagePath = filter_input(INPUT_POST, 'ImagePath');
$CategoryId = filter_input(INPUT_POST, 'CategoryId');
$IsFeatured = filter_input(INPUT_POST, 'IsFeatured');


// new array for error messages.
$error_messages = array();

// Actions for this controller
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_list';
    }
}

// Get all the categories for the dropdown selector
$categories = get_all_categories();

// This switch controls what action the page is responding to
switch ($action) {

    // Update the credentials of the admin account.
    case 'update_product':

        $form = new Form();

        $form->text("ProductName", "Product Name", $ProductName);
        $form->text("Description", "Description", $Description, TRUE, 1, 8000);
        $form->int("Stock", "Stock", $Stock);
        $form->float("PriceEach", "Price Each", $PriceEach);
        $form->text("ImagePath", "Image Path", $ImagePath, TRUE, 1, 255);
        $form->int("CategoryId", "Category", $CategoryId);
        $form->boolean("IsFeatured", "Is Featured", $IsFeatured);

        $error_messages = $form->getErrorMessages();

        // Check categoryId exists
        $category = get_category($CategoryId);
        
        if($category === NULL) {
            $error_messages[] = "Category doesn't exist.";
        }

        if(empty($error_messages)){
            
            // Success, update
            update_product($ProductId, $ProductName, $Description, $Stock, $PriceEach, $ImagePath, $CategoryId, $IsFeatured);
            
            $success_message = "You have updated product: $ProductName.";
            include('server/view/success.php');
            
        } else {
            
            // Failure, show the update form again
            include('admin/products/product_edit_view.php');
        }
        break;

    case 'view_update_product':

        $product = get_product($ProductId);
        
        $ProductName = $product['ProductName'];
        $Description = $product['Description'];
        $Stock = $product['Stock'];
        $PriceEach = $product['PriceEach'];
        $ImagePath = $product['ImagePath'];
        $CategoryId = $product['CategoryId'];
        $IsFeatured = $product['IsFeatured'];

        include('admin/products/product_edit_view.php');

        break;


    // Show the list
    case 'view_list':
    default:

        $products = get_all_products();

        // Show the list
        include('admin/products/list_products_view.php');
        break;
}