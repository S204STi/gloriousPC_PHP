<?php 

function get_web_root() {
    // Get the application path
    $uri = substr( __FILE__, strlen( $_SERVER[ 'DOCUMENT_ROOT' ] ) );
    $dirs = explode('/', $uri);
    $app_path = '/' . $dirs[1] . '/';
    return $app_path;
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
}

// This gets the location of our config.php, which is assumed to be in our root directory.
// We can then requre config to any page and use APP_ROOT as the basis of all other requires.
define("APP_ROOT", realpath(dirname(__FILE__)) . '/');
define("WEB_ROOT", get_web_root());

// Set the include path to the root of the project, which is the directory of this file.
set_include_path(APP_ROOT);

// Include common code
require_once('server/errors/error_routes.php');
require_once('server/database/connect.php');

// Start tracking the session for the user
session_start();

?>