<?php
session_start();

// Dummy credentials
$admin_user = "admin";
$admin_pass = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "❌ Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - Shadow Parties</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                  url('wedding-caterers-sydney-e1629788409535.jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
    }

    .login-box {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 15px;
      backdrop-filter: blur(10px);
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
      width: 350px;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #fff;
      font-weight: 600;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: none;
      border-radius: 8px;
      background-color: rgba(255,255,255,0.9);
      color: #000;
      font-size: 14px;
    }

    .login-box button {
      width: 100%;
      padding: 12px;
      background-color: #e91e63;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s ease;
    }

    .login-box button:hover {
      background-color: #c2185b;
    }

    .error {
      color: #ffdddd;
      background: rgba(255, 0, 0, 0.3);
      padding: 10px;
      margin-bottom: 15px;
      text-align: center;
      border-radius: 6px;
      font-size: 14px;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 12px;
      color: #ddd;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <div style="text-align:center; margin-top: 15px;">
  <a href="indexx.html" style="color: #fff; text-decoration: underline; font-size: 14px;">← Go to Homepage</a>
</div>

    <div class="footer">
      &copy; 2025 Shadow Parties
    </div>
  </div>

</body>
</html>
