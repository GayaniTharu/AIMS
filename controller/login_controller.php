<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["id1"];
    $password = $_POST["pw1"];
    
    // Perform database query to check if the provided credentials are valid
    $db = new mysqli("localhost", "root", "", "aims");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db->query($sql);
    
    if ($result->num_rows === 1) {
        // Valid credentials, user is authenticated
        $_SESSION["username"] = $username;
        header("Location: ../view/home2.php");
        exit;
    } else {
       // Invalid credentials, show an error message
        $response = "Invalid username or password";
        $res_status = "0";
        header("Location: ../view/login.php?response=$response&res_status=$res_status");
        exit;

    }
} else {
    header("Location: ../view/login.php");
    exit;
}

?>



<?php
// Include necessary libraries and database connection setup

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user's provided email from the form
    $userEmail = $_POST["email"];

    // Check if the email exists in your 'user_reg' table in the 'aims' database
    $servername = "localhost"; // Replace with your database server address
    $username = "root"; // Replace with your database username
    $password = " "; // Replace with your database password
    $dbname = "aims"; // Replace with your database name

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to check if the email exists
    $sql = "SELECT * FROM user_reg WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Email exists in the 'user_reg' table, send a reset password email

        // Generate and send the email with the reset password link
        // You can use the PHPMailer code provided earlier to send the email with a reset link

        // Redirect or display a success message to the user
        echo "Password reset email sent to $userEmail";
    } else {
        // Email not found in the 'user_reg' table, display an error message or redirect as needed
        echo "Email not found in our records";
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle other cases or show the login form
}











