<?php
// needed on all pages
require_once('../config.php');
include('server/view/header.php');

// save the referring page to redirect
$_SESSION['previousURL'] = $_SERVER['HTTP_REFERER'];
?>

<h1>Login</h1>

<p>Stuff here.</p>

<?php include('server/view/footer.php'); ?>