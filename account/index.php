<?php
// needed on all pages
require_once('../config.php');

require_once('server/util/form.php');
require_once('server/database/customers.php');
require_once('server/database/users.php');

// Get all values this page might use, these can be used to remember user input between validation failures.
$UserName = filter_input(INPUT_POST, 'UserName');
$Password = filter_input(INPUT_POST, 'Password');
$Password2 = filter_input(INPUT_POST, 'Password2');
$FirstName = filter_input(INPUT_POST, 'FirstName');
$LastName = filter_input(INPUT_POST, 'LastName');
$Address1 = filter_input(INPUT_POST, 'Address1');
$Address2 = filter_input(INPUT_POST, 'Address2');
$City = filter_input(INPUT_POST, 'City');
$State = filter_input(INPUT_POST, 'State');
$Zip = filter_input(INPUT_POST, 'Zip');
$Email = filter_input(INPUT_POST, 'Email');

// new array for error messages.
$error_messages = array();

// Actions for this controller
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_login';
        if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
            $action = 'logout';
        }
    }
}

// This switch controls what action the page is responding to
switch ($action) {

    // Logout the user
    case 'logout':

        logout();
        break;

    // Login with the supplied credentials
    case 'login':

        login($UserName, $Password);
        break;

    // Register a new user
    case 'register':

        // Forms validate the input, this form will validate customer data.
        $form = new Form();

        $form->password_match('Password2', 'Retype Pwd', $Password, $Password2);
        $form->password('Password', 'Password', $Password);
        $form->text('UserName', 'User Name', $UserName);
        $form->text('FirstName', 'First Name', $FirstName);
        $form->text('LastName', 'Last Name', $LastName);
        $form->text('Address1', 'Address 1', $Address1);
        $form->text('Address2', 'Address 2', $Address2, FALSE);
        $form->text('City', 'City', $City);
        $form->state('State', 'State', $State);
        $form->zip('Zip', 'Zip', $Zip);
        $form->email('Email', 'Email', $Email);
        
        $error_messages = $form->getErrorMessages();

        if(get_user_by_userName($UserName)) {
            $error_messages[] = "This User Name is already in use.";        
        }

        if(empty($error_messages)){
            
            // Success! Create customer
            $userId = create_user($UserName, $Password);

            create_customer($FirstName, $LastName, $Address1, $Address2, $City, $State, $Zip, $Email, $userId);

            // login
            login($UserName, $Password);

            $success_message = "Welcome to Gloriousness!";
            include('server/view/success.php');

        } else {

            // Failure, show the register form again
            include('account/register_view.php');
        }
        break;

    // Edit the customer profile
    case 'update_profile':

        $form = new Form();

        $form->text('FirstName', 'First Name', $FirstName);
        $form->text('LastName', 'Last Name', $LastName);
        $form->text('Address1', 'Address 1', $Address1);
        $form->text('Address2', 'Address 2', $Address2, FALSE);
        $form->text('City', 'City', $City);
        $form->state('State', 'State', $State);
        $form->zip('Zip', 'Zip', $Zip);
        $form->email('Email', 'Email', $Email);

        $error_messages = $form->getErrorMessages();

        $current_user_id = $_SESSION['user'];

        if(empty($error_messages)){
            
            // Success, change the customer information
            update_customer($FirstName, $LastName, $Address1, $Address2, $City, $State, $Zip, $Email, $current_user_id);

            $success_message = "Your profile has been updated.";
            include('server/view/success.php');
        } else {

            // Failure, show the update form again
            include('account/profile_edit_view.php');
        }

        break;

    case 'update_user':

        $form = new Form();

        $form->text('UserName', 'User Name', $UserName);
        $form->password_match('Password2', 'Retype Pwd', $Password, $Password2);
        $form->password('Password', 'Password', $Password);
                
        $error_messages = $form->getErrorMessages();

        $existing_user = get_user_by_login($UserName);
        $current_user_id = $_SESSION['user'];

        // If the username exists and it doesn't belong to this user, we can't use that name.
        if(!empty($existing_user) && $existing_user['AppUserId'] != $current_user_id) {
            $error_messages[] = "This User Name is already in use.";        
        }

        if(empty($error_messages)){
            
            // Success, change the credentials
            update_user($UserName, $Password, $current_user_id);

            $success_message = "Your credentials have been updated.";
            include('server/view/success.php');
        } else {
            
            // Failure, show the update form again
            include('account/user_edit_view.php');
        }
        break;

    case 'view_register':

        // Show the register form
        include('account/register_view.php');

        break;

    case 'view_profile':

        $customer = get_customer_by_user_id($_SESSION['user']);

        // Populate the DOM with customer info
        $FirstName = $customer['FirstName'];
        $LastName = $customer['LastName'];
        $Address1 = $customer['Address1'];
        $Address2 = $customer['Address2'];
        $City = $customer['City'];
        $State = $customer['State'];
        $Zip = $customer['Zip'];
        $Email = $customer['Email'];

        // Show the profile edit
        include('account/profile_edit_view.php');

        break;

    case 'view_user':

        $customer = get_customer_by_user_id($_SESSION['user']);

        // Populate the DOM with user info
        $UserName = $customer['UserName'];

        // Show the profile edit
        include('account/user_edit_view.php');

        break;

    case 'view_login':
    default:

        // Default if no action sent and not logged in, show login form
        include('account/login_view.php');
        break;
}

function login($userName, $password) {
    global $UserName;

    $user = get_user_by_login($userName, $password);
            
    if($user == NULL) {

        $error_messages[] = "Invalid User Name or Password. Try again.";
        include('account/login_view.php');

    } else  {

        // Set the user Id in the session
        if($user['IsAdmin'] == TRUE) {
            $_SESSION['admin'] = $user['AppUserId'];
        } else {
            $_SESSION['user'] = $user['AppUserId'];
        }

        // If successful go home.
        go_home();
    }
}

function logout() {
    // Clear the session array on the server
    $_SESSION = array();

    // Delete the session cookie.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session.
    session_destroy();

    // Go home.            
    go_home();
}