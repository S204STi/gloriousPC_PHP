<?php 

// Convert a string within a paragraph tag into multiple paragraphs.
function html_tags($text) {
    $text = str_replace("\r\n", "</p><p>", $text);  // convert Windows
    $text = str_replace("\r", "</p><p>", $text);    // convert Mac

    return $text;
}
?>