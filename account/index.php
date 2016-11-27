<?php
// needed on all pages
require_once('../config.php');

// Actions might be login confirmation.
$action = filter_input(INPUT_POST, 'action');

// If logged in, then log out
if(isset($_SESSION['user']) || isset($_SESSION['admin'])) {
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
    header( 'Location: ' . $WEB_ROOT );

} else {

    include('server/view/header.php');

    require_once('server/database/customers.php');

    // User sent up credientials
    if($action == "login_confim") {
        
        // Verify login here
        $UserName = filter_input($_POST, 'UserName');
        $Password = filter_input($_POST, 'Password');

        

        // Go home.
        header( 'Location: ' . $WEB_ROOT );

    } else if($action == "register") {

        // Show the registration screen
        include('account/register.php');

    } else {

        // If the user isn't logged in and no action was sent, show login screen.
        include('account/login.php');
    }

    include('server/view/footer.php'); 
}



?>