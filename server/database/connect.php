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
    exit();
}
?>