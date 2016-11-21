<?php 

// This gets the location of our config.php, which is assumed to be in our root directory.
// We can then requre config to any page and use APP_ROOT as the basis of all other requires.
define("APP_ROOT", realpath(dirname(__FILE__)) . '/');

// Include common code
require_once(APP_ROOT . 'server/errors/error_routes.php');
require_once(APP_ROOT . 'server/database/connect.php');


// Start tracking the session for the user
session_start();

?>