<?php 

// TODO: make a config.php in root with
// define( "APP_ROOT", realpath( dirname( __FILE__ ) ).'/' );
// Use like require_once( APP_ROOT.'path/to/file.php' );
// Then we can have nested requires

define("APP_ROOT", realpath(dirname(__FILE__)) . '/');

// Include common code
require_once(APP_ROOT . 'server/errors/error_routes.php');
require_once(APP_ROOT . 'server/database/connect.php');


// Start tracking the session for the user
session_start();

?>