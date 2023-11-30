<?php
include_once("../view/navigationBar.php");



$response = isset($_GET["response"]) ? $_GET["response"] : ""; // add user eke response eka link krnwa
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";
$email = isset($_SESSION["otp"]) ? $_SESSION["otp"]["email"] : "";

?>




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

// Fetch data from the 'lands' table
$query = "SELECT land_location, COUNT(*) as count FROM lands GROUP BY land_location";
$result = $conn->query($query);

// Prepare data for the chart
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['land_location']] = $row['count'];
}

// Convert data to JSON for JavaScript
$dataJSON = json_encode($data);


// pie chart-------------------------------------------------------------------------------------------

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

// Initialize an array to store data for each type of fertilizer
$fertilizerData = [];

// Fetch data for each type of fertilizer from the 'fertilizer' table
$query = "SELECT SUM(urea1) as urea1_total, SUM(urea2) as urea2_total, SUM(urea3) as urea3_total, SUM(tsp) as tsp_total, SUM(mop) as mop_total, SUM(zs) as zs_total FROM fertilizer";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fertilizerData = $row;
}

// Convert data to JSON for JavaScript
$fertilizerDataJSON = json_encode($fertilizerData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>

<div class="container">
    <table class="table table-bordered">
        <tr>
            <td>
                <!-- Bar Chart -->
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Print</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body mb-3">
                        <canvas id="barChart" width="400" height="300"></canvas> <!-- Adjust the size here -->
                    </div>
                </div>
            </td>
            <td>
                <!-- Pie Chart -->
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Print</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body mb-3">
                        <canvas id="fertilizerChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
    <script>
        // Parse the JSON data from PHP
        var chartData = <?php echo $dataJSON; ?>;

        // Extract labels and data from the JSON data
        var labels = Object.keys(chartData);
        var data = Object.values(chartData);

        // Create a bar chart
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Land Location Count',
            data: data,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            animation: {  // Add animation options for the dataset
                duration: 2000, // Set the animation duration in milliseconds (e.g., 2000 ms)
                easing: 'easeOutBounce', // Set the easing function (optional)
            },
        }],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
        animation: {
            duration: 2000, // Set the animation duration for the entire chart (optional)
            easing: 'easeOutBounce', // Set the easing function for the entire chart (optional)
        },
    },
});



         // pie chart-------------------------------------------------------------------------------

    // Parse the JSON data from PHP
    var fertilizerData = <?php echo $fertilizerDataJSON; ?>;

// Extract data values and labels
var dataValues = Object.values(fertilizerData);
var dataLabels = Object.keys(fertilizerData);

// Specify the colors for the pie chart segments
var backgroundColors = ['#003f5c', '#58508d', '#bc5090', '#dd5182', '#ff6e54', '#488f31'];

var ctxFertilizer = document.getElementById('fertilizerChart').getContext('2d');
var fertilizerChart = new Chart(ctxFertilizer, {
    type: 'pie',
    data: {
        labels: dataLabels,
        datasets: [{
            data: dataValues,
            backgroundColor: backgroundColors,
            animation: {  // Add animation options for the dataset
                duration: 1000, // Set the animation duration in milliseconds (e.g., 1000 ms)
                easing: 'easeInOutQuart', // Set the easing function (optional)
            },
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Set to false to adjust the size
        title: {
            display: true,
            text: 'Fertilizer Types'
        },
        animation: {
            duration: 1000, // Set the animation duration for the entire chart (optional)
            easing: 'easeInOutQuart', // Set the easing function for the entire chart (optional)
        },
    }
});




















