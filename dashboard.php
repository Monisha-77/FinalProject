<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                  url('shadow.jpg') no-repeat center center/cover;
      color: #fff;
      min-height: 100vh;
    }

    .header {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 20px;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }

    .top-bar {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 12px 30px;
      display: flex;
      justify-content: flex-end;
    }

    .top-bar a {
      color: #ff6961;
      text-decoration: none;
      font-weight: bold;
    }

    .container {
      padding: 30px;
      margin: 0 auto;
      max-width: 1200px;
      backdrop-filter: blur(8px);
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      margin-top: 30px;
    }

    h2 {
      color: #fff;
      margin-top: 30px;
      margin-bottom: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: rgba(255, 255, 255, 0.15);
      margin-bottom: 30px;
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 14px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      color: #fff;
      font-size: 12px;
    }

    th {
      background-color: rgba(40, 167, 69, 0.9);
      color: white;
    }

    tr:hover {
      background-color: rgba(255, 255, 255, 0.05);
    }

    .footer {
      text-align: center;
      padding: 20px;
      font-size: 12px;
      color: #ddd;
    }
  </style>
</head>
<body>

  <div class="header">Admin Dashboard - Shadow Parties</div>

  <div class="top-bar">
    Logged in as Admin | <a href="logout.php">Logout</a>
  </div>

  <div class="container">
    <h2>Contact Queries</h2>
    <?php
    $conn = new mysqli("localhost", "root", "", "eventplanner_db");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $contact_result = $conn->query("SELECT * FROM contact_queries ORDER BY submitted_at DESC");

    if ($contact_result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Subject</th><th>Message</th><th>Submitted At</th></tr>";
        while ($row = $contact_result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['number']}</td><td>{$row['email']}</td><td>{$row['subject']}</td><td>{$row['message']}</td><td>{$row['submitted_at']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No contact queries found.</p>";
    }

    echo "<h2>Registered Users</h2>";
    $user_result = $conn->query("SELECT * FROM users");
    if ($user_result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Password</th></tr>";
        while ($row = $user_result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['fullname']}</td><td>{$row['email']}</td><td>{$row['phone']}</td><td>{$row['password']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No registered users found.</p>";
    }

    $conn->close();
    ?>
  </div>

  <div class="footer">
    &copy; 2025 Shadow Parties. Admin Dashboard.
  </div>

</body>
</html>
