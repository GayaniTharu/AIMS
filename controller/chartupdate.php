<?php
// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'aims';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch updated data from the 'lands' table (you can adapt this query)
$query = "SELECT land_location, COUNT(*) as count FROM lands GROUP BY land_location";
$result = $conn->query($query);

// Prepare data for the chart
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['land_location']] = $row['count'];
}

// Close the database connection
$conn->close();

// Send the updated data as JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
