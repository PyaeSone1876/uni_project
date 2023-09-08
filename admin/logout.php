<?php
session_start(); // Start or resume the current session

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();
    
    // Redirect the user to the login page or any other desired page
    header("Location:../useroptions/userOptions.php");
    exit();
} 
?>
