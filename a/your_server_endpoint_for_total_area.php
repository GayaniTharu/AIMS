<?php
// Assuming you have a database connection established
$mysqli = new mysqli("localhost", "root", "", "aims");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve the landnumber from the POST request
$landnumber = $_POST['landnumber'];

// Fetch the total_area based on the selected landnumber
$sql = "SELECT land_size FROM lands WHERE land_number = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $landnumber);
$stmt->execute();
$stmt->bind_result($totalArea);
$stmt->fetch();
$stmt->close();

// Return the result as JSON
echo json_encode(['totalArea' => $totalArea]);

// Close the database connection
$mysqli->close();
?>
