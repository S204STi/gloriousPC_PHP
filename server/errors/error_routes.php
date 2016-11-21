<?php

// Define some common functions
function display_db_error($error_message) {
    global $app_path;
    include(APP_ROOT . 'server/errors/db_error.php');
    exit;
}

function display_error($error_message) {
    global $app_path;
    include(APP_ROOT . 'server/errors/error.php');
    exit;
}

function redirect($url) {
    session_write_close();
    header("Location: " . $url);
    exit;
}

?>