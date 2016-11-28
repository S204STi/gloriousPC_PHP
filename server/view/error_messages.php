<?php 
    if(isset($error_messages)){
        echo "<ul class='error'>";
        foreach($error_messages as $error_message) {
            $error_message = htmlspecialchars($error_message);
            echo "<li>$error_message</li>";
        }
        echo "</ul>";
    }
?>