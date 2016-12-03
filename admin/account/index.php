<?php
// needed on all pages
require_once('../../config.php');

require_once('server/util/form.php');
require_once('server/database/users.php');

// authenticate that they are admin, if not then show forbidden page
if (!isset($_SESSION['admin'])) {
    forbidden();
}

// Get all values this page might use, these can be used to remember user input between validation failures.
$UserName = filter_input(INPUT_POST, 'UserName');
$Password = filter_input(INPUT_POST, 'Password');
$Password2 = filter_input(INPUT_POST, 'Password2');

// new array for error messages.
$error_messages = array();

// Actions for this controller
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_update';
    }
}

// This switch controls what action the page is responding to
switch ($action) {

    // Update the credentials of the admin account.
    case 'update_admin':

        $form = new Form();

        $form->text('UserName', 'User Name', $UserName);
        $form->password_match('Password2', 'Retype Pwd', $Password, $Password2);
        $form->password('Password', 'Password', $Password);
                
        $error_messages = $form->getErrorMessages();

        $existing_user = get_user_by_userName($UserName);
        $current_user_id = $_SESSION['admin'];

        // If the username exists and it doesn't belong to this user, we can't use that name.
        if(!empty($existing_user) && $existing_user['AppUserId'] != $current_user_id) {
            $error_messages[] = "This User Name is already in use.";        
        }

        if(empty($error_messages)){
            
            // Success, change the credentials
            update_user($UserName, $Password, $current_user_id);
            
            $success_message = "You have changed your admin credentials.";
            include('server/view/success.php');
            
        } else {
            
            // Failure, show the update form again
            include('admin/account/admin_edit_view.php');
        }
        break;

    // Show the update form
    case 'view_update':
    default:

        $user = get_user($_SESSION['admin']);

        // Populate the DOM with user info
        $UserName = $user['UserName'];

        // Show the profile edit
        include('admin/account/admin_edit_view.php');
        break;
}