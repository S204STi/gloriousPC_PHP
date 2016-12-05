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
$ProductId = filter_input(INPUT_GET, 'product_id');
if($ProductId === NULL) {
    $ProductId = filter_input(INPUT_POST, 'ProductId');
}
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
        $existing_category = get_category($CategoryId);
        
        if($existing_category === NULL) {
            $error_messages[] = "Category doesn't exist.";
        }

        if(empty($error_messages)){
            
            // Success, update
            update_product($ProductName, $Description, $Stock, $PriceEach, $ImagePath, $CategoryId, $IsFeatured, $ProductId);
            
            $success_message = "You have updated product: $ProductName.";
            include('server/view/success.php');
            
        } else {
            
            // Failure, show the update form again
            include('admin/products/edit_view.php');
        }
        break;

    // Update the credentials of the admin account.
    case 'add_product':

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
        $existing_category = get_category($CategoryId);
        
        if($existing_category === NULL) {
            $error_messages[] = "Category doesn't exist.";
        }

        if(empty($error_messages)){
            
            // Success, update
            create_product($ProductName, $Description, $Stock, $PriceEach, $ImagePath, $CategoryId, $IsFeatured);
            
            $success_message = "You have added product: $ProductName.";
            include('server/view/success.php');
            
        } else {
            
            // Failure, show the update form again
            include('admin/products/edit_view.php');
        }
        break;

    case 'delete_product':

        $product = get_product($ProductId);
        $ProductName = $product['ProductName'];

        if(empty($ProductName)) {
            display_error("That product doesn't exist.");
        } else {
            delete_product($ProductId);

            $success_message = "You have deleted product: $ProductName.";
            include('server/view/success.php');
        }

        break;

    // Show the update view
    case 'view_update':

        $product = get_product($ProductId);
        
        $ProductId = $product['ProductId'];
        $ProductName = $product['ProductName'];
        $Description = $product['Description'];
        $Stock = $product['Stock'];
        $PriceEach = $product['PriceEach'];
        $ImagePath = $product['ImagePath'];
        $CategoryId = $product['CategoryId'];
        $IsFeatured = $product['IsFeatured'];

        include('admin/products/edit_view.php');

        break;

    // Show the add view
    case 'view_add':

        $product = get_product($ProductId);
        
        $ProductName = '';
        $Description = '';
        $Stock = '';
        $PriceEach = '';
        $ImagePath = '';
        $CategoryId = '';
        $IsFeatured = '';

        include('admin/products/add_view.php');

        break;


    // Show the list
    case 'view_list':
    default:

        $list_title = "Manage Products";
        $list_description = "Select a product to edit it.";
        $products = get_all_products();

        // Show the list
        include('admin/products/table_view.php');
        break;
}