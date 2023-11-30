<?php
// Assuming you have a database connection established
$mysqli = new mysqli("localhost", "root", "", "aims");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch land numbers based on the provided NIC
if (isset($_POST['nic'])) {
    $nic = $_POST['nic'];

    $query = "SELECT DISTINCT land_number FROM lands WHERE far_nic = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $nic);

    $stmt->execute();
    $result = $stmt->get_result();

    $landNumbers = [];

    while ($row = $result->fetch_assoc()) {
        $landNumbers[] = $row['land_number'];
    }

    $stmt->close();

    // Return the result as JSON
    echo json_encode(['landNumbers' => $landNumbers]);
} else {
    // Handle the case where NIC is not set
    echo json_encode(['error' => 'NIC not provided']);
}

// Close the database connection
$mysqli->close();
?>
