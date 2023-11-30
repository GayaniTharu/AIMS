<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .password-container {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="authenticate.php" method="post">
            <h2>Login</h2>
            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            }
            ?>
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password" class="password-container">Password:
                <input type="password" name="password" id="password" required>
                <span class="eye-icon" id="eye-icon">👁️</span>
            </label>

            <label for="role">Select Role:</label>
            <select name="role" required>
                <option value="DO">DO</option>
                <option value="SDO">SDO</option>
                <option value="AI">AI</option>
                <option value="ARP">ARP</option>
            </select>

            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            eyeIcon.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
            });
        });
    </script>
</body>
</html>
