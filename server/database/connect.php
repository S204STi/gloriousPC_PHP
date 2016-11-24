<?php

function connect_database() {
    // Set up the database connection
    $dsn = 'mysql:host=localhost;dbname=GloriousDb';
    $username = 'gloriousDbUser';
    $password = 'bpMxnZ2Yx2d6txRm';
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $db = new PDO($dsn, $username, $password, $options);
        return $db;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        exit();
    }
}

$db = connect_database();

?>