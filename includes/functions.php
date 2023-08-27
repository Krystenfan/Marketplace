<?php

//a safe method to recieve post data.
function mypost($str) { 
    $value = !empty($_POST[$str]) ? $_POST[$str] : '';
    return $value;
}       

function simulatePayment() {
    // Placeholder simulation of payment process
    $randomSuccess = rand(0, 1); // Randomly generate success or failure
    return $randomSuccess;
}
?>