<?php
require_once 'config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = '$role'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $role = $row['role'];

        // Authentication successful
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        switch ($role) {
            case 'DO':
                header("Location: ../view/home2.php");
                break;
            case 'SDO':
                header("Location: user2.php");
                break;
            case 'AI':
                header("Location: ../view/addnews.php");
                break;
            case 'ARP':
                header("Location: user4.php");
                break;
            default:
                // Handle other roles or redirect to a default page
                header("Location: default.php");
                break;
        }
    } else {
        // Authentication failed
        $error_message = "Invalid username, password, or role. Please try again.";
        $_SESSION['error_message'] = $error_message;
        header("Location: login.php");
    }
}
?>
