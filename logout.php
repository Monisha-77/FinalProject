<?php
session_start();

// Optional: You can check who is logging out
if (isset($_SESSION["admin"])) {
    // Destroy session and redirect to admin login
    session_destroy();
    header("Location: admin_login.php");
    exit;
} elseif (isset($_SESSION["customer_email"])) {
    // Destroy session and redirect to homepage or customer login
    session_destroy();
    header("Location: indexx.html"); // Or: customer_login.php
    exit;
} else {
    // Default fallback
    session_destroy();
    header("Location: indexx.html");
    exit;
}
?>
