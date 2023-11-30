<!-- delete_farmer.php -->
<?php
if (isset($_GET['far_nic'])) {
    $nic = $_GET['far_nic'];

    // Establish a database connection (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = ""; // Put your database password here
    $dbname = "aims";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to delete the record
    $stmt = $conn->prepare("DELETE FROM far_reg  WHERE far_nic = ?");
    $stmt->bind_param("i", $nic);

    if ($stmt->execute()) {
        // Successful deletion
        header("Location: ../view/farmer_reg.php"); // Redirect to the page after deletion
        exit();
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request, no farmer_id provided
    echo "Invalid request.";
}
?>
