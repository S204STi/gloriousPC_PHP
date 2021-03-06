<?php

// Define some common functions
function display_db_error($error_message) {
    include('server/errors/db_error.php');
    exit;
}

function display_error($error_message) {
    include('server/errors/error.php');
    exit;
}

function redirect($url) {
    session_write_close();
    header("Location: " . $url);
    exit;
}

function forbidden() {
    header('HTTP/1.0 403 Forbidden');
    display_error("Forbidden: You do not have permission.");
}

?>