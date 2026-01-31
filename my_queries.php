<?php
session_start();
if (!isset($_SESSION["customer_email"])) {
    header("Location: customer_login.php");
    exit;
}

$email = $_SESSION["customer_email"];
$conn = new mysqli("localhost", "root", "", "eventplanner_db");

$result = $conn->query("SELECT * FROM contact_queries WHERE email = '$email'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Queries</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f2f2f2;
      padding: 40px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #28a745;
      color: white;
    }
    h2 {
      margin-bottom: 20px;
    }
    .logout {
      text-align: right;
      margin-bottom: 20px;
    }
    .logout a {
      text-decoration: none;
      color: #d00;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="logout">
  <a href="logout.php">Logout</a>
</div>

<h2>Your Submitted Queries</h2>

<?php
if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Subject</th><th>Message</th><th>Submitted At</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['subject']}</td><td>{$row['message']}</td><td>{$row['submitted_at']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No queries found for your email.</p>";
}
?>

</body>
</html>
