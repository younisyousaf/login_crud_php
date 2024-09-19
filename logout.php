<?php
session_start();

// Destroy the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session itself

// Redirect to login page after logout
header("Location: index.php");
exit();
