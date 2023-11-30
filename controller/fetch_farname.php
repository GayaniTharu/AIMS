<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aims";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the NIC value from the AJAX request
$nic = $_POST["nic"];

// Query the database to retrieve the farname
$sql = "SELECT far_fname FROM far_reg WHERE far_nic = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nic);
$stmt->execute();
$stmt->bind_result($farname);

if ($stmt->fetch()) {
    // Return the farname as the response
    echo $farname;
} else {
    // Handle the case when no matching record is found
    echo ""; // or any appropriate message
}

$stmt->close();
$conn->close();
?>
