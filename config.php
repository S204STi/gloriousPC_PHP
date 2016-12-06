<?php 

function get_web_root() {
    // Get the application file path
    $uri = substr( __FILE__, strlen( $_SERVER[ 'DOCUMENT_ROOT' ] ) );

    // Split for unix
    $dirs = explode('/', $uri);

    try {
        // make an absolute url that points to the base of the app
        @ $app_path = '/' . $dirs[1] . '/';
    } catch (Exception $e) {
        // Split for windows in case the unix version doesn't work.
        $dirs = explode('\\', $uri);
        $app_path = '/' . $dirs[1] . '/';
    }
    
    return $app_path;
}

// This gets the location of our config.php, which is assumed to be in our root directory.
// We can then requre config to any page and use APP_ROOT as the basis of all other requires.
define("APP_ROOT", realpath(dirname(__FILE__)) . '/');
define("WEB_ROOT", get_web_root());

// Set the include path to the root of the project, which is the directory of this file.
set_include_path(APP_ROOT);

// Easy button for redirecting home
function go_home() {
    header( 'Location: ' . WEB_ROOT );
}

// Include common code
require_once('server/errors/error_routes.php');
require_once('server/database/connect.php');

// Start tracking the session for the user
session_start();

?>