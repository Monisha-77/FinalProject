<?php
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = ""; // Default in XAMPP
$database = "eventplanner_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Insert query
$sql = "INSERT INTO contact_queries (name, number, email, subject, message) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $number, $email, $subject, $message);

if ($stmt->execute()) {
    echo "<h2 style='color:green;'>✅ Your query has been submitted successfully!</h2>";
} else {
    echo "<h2 style='color:red;'>❌ Error: " . $stmt->error . "</h2>";
}

$stmt->close();
$conn->close();
?>
