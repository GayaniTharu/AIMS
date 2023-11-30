<?php
// your_server_endpoint.php

// Assuming you have a database connection established
$mysqli = new mysqli("localhost", "root", "", "aims");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get the NIC value from the AJAX request
$nic = $_POST['nic'];

// Query the database to retrieve the inputAmount and land_number based on the NIC
$query = "SELECT land_size, land_number FROM lands WHERE far_nic = '$nic'";
$result = $mysqli->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data = array(
            "land_size" => $row['land_size'],
            "landnumber" => $row['land_number']
        );
        echo json_encode($data);
    } else {
        echo json_encode(array("error" => "NIC not found in the database"));
    }
} else {
    // Handle query errors
    echo json_encode(array("error" => mysqli_error($mysqli)));
}

$mysqli->close();

?>
