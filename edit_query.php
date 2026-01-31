<?php
session_start();
if (!isset($_SESSION["customer_email"])) {
    header("Location: customer_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "eventplanner_db");

if (!isset($_GET["id"])) {
    die("Invalid query ID.");
}

$id = $_GET["id"];
$email = $_SESSION["customer_email"];

// Fetch the query to edit
$stmt = $conn->prepare("SELECT * FROM contact_queries WHERE id = ? AND email = ?");
$stmt->bind_param("is", $id, $email);
$stmt->execute();
$result = $stmt->get_result();
$query = $result->fetch_assoc();

if (!$query) {
    die("Query not found or access denied.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $update = $conn->prepare("UPDATE contact_queries SET subject = ?, message = ? WHERE id = ? AND email = ?");
    $update->bind_param("ssis", $subject, $message, $id, $email);
    $update->execute();

    header("Location: customer_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Query</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                  url('shadow.jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }

    .edit-box {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 30px;
      width: 100%;
      max-width: 500px;
      border-radius: 12px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #fff;
    }

    label {
      display: block;
      margin: 10px 0 6px;
      font-weight: 500;
    }

    input, textarea {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      background: rgba(255, 255, 255, 0.3);
      color: #000;
    }

    textarea {
      resize: vertical;
      height: 120px;
    }

    button {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background-color: #28a745;
      border: none;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #218838;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      color: #ccc;
      font-size: 14px;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="edit-box">
  <h2>Edit Your Query</h2>
  <form method="POST">
    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($query['subject']); ?>" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" required><?php echo htmlspecialchars($query['message']); ?></textarea>

    <button type="submit">Update Query</button>
    <a class="back-link" href="customer_dashboard.php">← Back to Dashboard</a>
  </form>
</div>

</body>
</html>
