<?php
session_start();
if (!isset($_SESSION["customer_email"])) {
    header("Location: customer_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "eventplanner_db");
$email = $_SESSION["customer_email"];

// Fetch customer queries
$stmt = $conn->prepare("SELECT * FROM contact_queries WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Queries</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                  url('shadow.jpg') no-repeat center center/cover;
      font-family: 'Poppins', sans-serif;
      color: white;
      min-height: 100vh;
      margin: 0;
    }

    .header {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 20px;
      text-align: center;
      font-size: 20px;
    }

    .logout {
      text-align: right;
      padding: 10px 30px;
    }

    .logout a {
      color: #ff4d4d;
      text-decoration: none;
      font-weight: bold;
    }

    .content {
      max-width: 1000px;
      margin: 30px auto;
      padding: 20px;
      background-color: rgba(255,255,255,0.1);
      border-radius: 12px;
      backdrop-filter: blur(10px);
    }

    h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(255,255,255,0.15);
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid rgba(255,255,255,0.2);
      font-size: 13px;
      text-align: center;
    }

    th {
      background-color: #28a745;
      color: white;
    }

    tr:hover {
      background-color: rgba(255,255,255,0.1);
    }

    a.action-link {
      text-decoration: none;
      font-weight: bold;
      margin: 0 6px;
    }

    .edit {
      color: lightblue;
    }

    .delete {
      color: salmon;
    }

    .action-link:hover {
      text-decoration: underline;
    }

    .footer {
      text-align: center;
      color: #ccc;
      padding: 20px;
      font-size: 13px;
    }
  </style>
</head>
<body>

  <div class="header">Welcome, <?php echo htmlspecialchars($email); ?></div>
  <div class="logout"><a href="logout.php">Logout</a></div>

  <div class="content">
    <h3>Your Submitted Queries</h3>
    <?php
    if ($result->num_rows > 0) {
        echo "<table><tr>
                <th>Subject</th>
                <th>Message</th>
                <th>Submitted At</th>
                <th>Actions</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['subject']) . "</td>
                    <td>" . htmlspecialchars($row['message']) . "</td>
                    <td>" . $row['submitted_at'] . "</td>
                    <td>
                      <a class='action-link edit' href='edit_query.php?id={$row['id']}'>Edit</a>
                      |
                      <a class='action-link delete' href='delete_query.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this query?');\">Delete</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>You haven’t submitted any queries yet.</p>";
    }
    ?>
  </div>

  <div class="footer">&copy; 2025 Shadow Parties Events - Customer Panel</div>

</body>
</html>
