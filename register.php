<?php
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = ""; // Default is blank in XAMPP
$database = "eventplanner_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

// Insert into MySQL
$sql = "INSERT INTO users (fullname, email, phone, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $email, $phone, $password);

if ($stmt->execute()) {
    echo "<h2 style='color:green;'>✅ Registration successful!</h2>";
} else {
    echo "<h2 style='color:red;'>❌ Error: " . $stmt->error . "</h2>";
}

$stmt->close();
$conn->close();
?>
