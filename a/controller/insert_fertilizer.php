<?php
// your_server_endpoint.php

// Assuming you have a database connection established
$mysqli = new mysqli("localhost", "root", "", "aims");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get data from the POST request
$nic = $_POST['nic'];
$landnumber = $_POST['landnumber'];
$inputAmount = $_POST['inputAmount'];
$urea1 = $_POST['urea1'];
$urea2 = $_POST['urea2'];
$urea3 = $_POST['urea3'];
$tsp = $_POST['tsp'];
$mop = $_POST['mop'];
$zs = $_POST['zs'];

// Perform the database insertion
$sql = "INSERT INTO fertilizer (nic, land_number, total_area, urea1, urea2, urea3, tsp, mop, zs) 
        VALUES ('$nic', '$landnumber', '$inputAmount', '$urea1', '$urea2', '$urea3', '$tsp', '$mop', '$zs')";

if ($mysqli->query($sql) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
