<?php
session_start();
if (!isset($_SESSION["customer_email"])) {
    header("Location: customer_login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $email = $_SESSION["customer_email"];

    $conn = new mysqli("localhost", "root", "", "eventplanner_db");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Ensure only the owner's query can be deleted
    $stmt = $conn->prepare("DELETE FROM contact_queries WHERE id = ? AND email = ?");
    $stmt->bind_param("is", $id, $email);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

header("Location: customer_dashboard.php");
exit;
?>
