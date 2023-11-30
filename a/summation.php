<?php
// Your database connection code here

// Assuming you have a database connection established
$mysqli = new mysqli("localhost", "root", "", "aims");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch the sum of each field from the table
$query = "SELECT 
    SUM(total_area) AS total_area_sum,
    SUM(urea1) AS urea1_sum,
    SUM(urea2) AS urea2_sum,
    SUM(urea3) AS urea3_sum,
    SUM(tsp) AS tsp_sum,
    SUM(mop) AS mop_sum,
    SUM(zs) AS zs_sum
FROM fertilizer";

$result = mysqli_query($mysqli, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $summationData = [
        'total_area_sum' => $row['total_area_sum'],
        'urea1_sum' => $row['urea1_sum'],
        'urea2_sum' => $row['urea2_sum'],
        'urea3_sum' => $row['urea3_sum'],
        'tsp_sum' => $row['tsp_sum'],
        'mop_sum' => $row['mop_sum'],
        'zs_sum' => $row['zs_sum'],
    ];

    // JSON response for AJAX
    $response = ['data' => [$summationData]];

    // Output the JSON response
    echo json_encode($response);
} else {
    // Handle query error
    echo json_encode(['error' => 'Error executing query']);
}

// Close the database connection
mysqli_close($mysqli);
?>
