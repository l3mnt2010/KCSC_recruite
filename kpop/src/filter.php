<?php
function containsDangerousCharacters($inputString)
{
    $specialCharacters = array("`", "\"", "'", "-", "#","flag","sleep","benchmark");

    foreach ($specialCharacters as $char) {
        if (strpos($inputString, $char) !== false) {
            return true;
        }
    }

    return false;
}

foreach ($_POST as $i) {
    if (containsDangerousCharacters(strtolower((string)$i))) {
        http_response_code(403);
        die("Dangerous Character");
    }
}
