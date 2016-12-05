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
$CategoryId = filter_input(INPUT_GET, 'category_id');
if($CategoryId === NULL) {
    $CategoryId = filter_input(INPUT_POST, 'CategoryId');
}
$CategoryName = filter_input(INPUT_POST, 'CategoryName');

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

// This switch controls what action the page is responding to
switch ($action) {

    // Update the credentials of the admin account.
    case 'update_category':

        $form = new Form();

        $form->text("CategoryName", "CategoryName", $CategoryName, TRUE, 1, 100);

        $error_messages = $form->getErrorMessages();

        if(empty($error_messages)){
            
            // Success, update
            update_category($CategoryName, $CategoryId);
            
            $success_message = "You have updated category: $CategoryName.";
            include('server/view/success.php');
            
        } else {
            
            // Failure, show the update form again
            include('admin/categories/edit_view.php');
        }
        break;

    // Update the credentials of the admin account.
    case 'add_category':

        $form = new Form();

        $form->text("CategoryName", "CategoryName", $CategoryName, TRUE, 1, 100);
        
        $error_messages = $form->getErrorMessages();

        if(empty($error_messages)){
            
            // Success, update
            create_category($CategoryName);
            
            $success_message = "You have added category: $CategoryName.";
            include('server/view/success.php');
            
        } else {
            
            // Failure, show the update form again
            include('admin/categories/edit_view.php');
        }
        break;

    case 'delete_category':

        $category = get_category($CategoryId);
        $CategoryName = $category['CategoryName'];

        if(empty($CategoryName)) {
            display_error("That category doesn't exist.");
        } else {
            delete_category($CategoryId);

            $success_message = "You have deleted category: $CategoryName.";
            include('server/view/success.php');
        }

        break;

    // Show the update view
    case 'view_update':

        $category = get_category($CategoryId);
        
        $CategoryId = $category['CategoryId'];
        $CategoryName = $category['CategoryName'];

        include('admin/categories/edit_view.php');

        break;

    // Show the add view
    case 'view_add':

        $CategoryId = '';
        $CategoryName = '';

        include('admin/categories/add_view.php');

        break;


    // Show the list
    case 'view_list':
    default:

        $list_title = "Manage Product Categories";
        $list_description = "Select a category to edit it.";
        
        // Get all the categories for the dropdown selector
        $categories = get_all_categories();

        // Show the list
        include('admin/categories/table_view.php');
        break;
}