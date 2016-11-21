<?php 

// Set up the database connection
$dsn = 'mysql:host=localhost;dbname=GloriousDb';
$username = 'gloriousDbUser';
$password = 'bpMxnZ2Yx2d6txRm';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../errors/db_error_connect.php');
    exit();
}

// Define some common functions
function display_db_error($error_message) {
    global $app_path;
    include '../errors/db_error.php';
    exit;
}

function display_error($error_message) {
    global $app_path;
    include '../errors/error.php';
    exit;
}

function redirect($url) {
    session_write_close();
    header("Location: " . $url);
    exit;
}

// Start tracking the session for the user
session_start();

?>