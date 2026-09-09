<?php
function cleanInputText($rawInput)
{
    $cleanedInput = trim($rawInput);
    $cleanedInput = stripslashes($cleanedInput);
    $cleanedInput = htmlspecialchars($cleanedInput);

    return $cleanedInput;
}