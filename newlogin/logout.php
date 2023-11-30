<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        h2, p {
            margin-bottom: 16px;
        }

        a {
            text-decoration: none;
            color: #333;
            cursor: pointer;
        }

        a:hover {
            color: #4caf50;
        }
    </style>
    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Logout</h2>
        <?php
        if (isset($_SESSION['username'])) {
            echo '<p>Welcome, ' . $_SESSION['username'] . '!</p>';
        }
        ?>
        <p><a href="logout-process.php" onclick="return confirmLogout();">Logout</a></p>
    </div>
</body>
</html>
