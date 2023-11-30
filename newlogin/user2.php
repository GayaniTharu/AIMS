<?php
include_once("../view/navigationbarDO.php");
?>

    <div class="container">
        <!-- Centered "Admin dashboard" heading -->
        <div class="text-center mt-5">

        <h1 style="font-family: 'Times New Roman', serif; font-weight: bold; text-align: left 30px ;">Welcome !</h1>
        <h4 style="font-family: 'Times New Roman', serif; font-weight: bold; text-align: left 30px ;">( Development Officer)</h4>
        
        <br>
            <!-- <h2 style="color: red;"> <h2 style="color:fire;" >Welcome! <br><br></h2> -->
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Change the background color of the body */
        body {
            background-color: #f0f0f0; /* Light gray background color */
        }
    </style>
<link rel="stylesheet" href="allcss.css">
</body>
</html>







<div class="row">
  <div class="col-md-9">
    <div class="container text-center">
      <div class="row justify-content-center">
        <div class="col-sm-5 mb-4">
          <div class="card bg-dark text-dark">
            <div class="card-body">
              <i class="fas fa-id-card fa-3x text-light "></i>
              <h5 class="card-title text-light">Farmer Registration</h5>
              <a href="../view/farmer_reg.php" class="btn btn-outline-warning btn-xl"><i class="fas fa-arrow-right"></i> Go to the form >></a>
            </div>
          </div>
        </div>
        <div class="col-sm-5 mb-4">
          <div class="card bg-dark text-dark">
            <div class="card-body">
              <i class="fas fa-info-circle fa-3x text-light"></i>
              <h5 class="card-title text-light"> View Farmer Details</h5>
              <a href="../view/view_farmer.php" class="btn btn-outline-warning btn-xl"><i class="fas fa-arrow-right "></i> Go to the form >></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container text-center">
      <div class="row justify-content-center">
        <div class="col-sm-5 mb-4">
          <div class="card bg-dark text-dark">
            <div class="card-body">
              <i class="fas fa-seedling fa-3x text-light"></i>
              <h5 class="card-title text-light">Manage Fertilizer Details</h5>
              <a href="../a/cal.php" class="btn btn-outline-warning btn-xl"><i class="fas fa-arrow-right "></i> Go to the form >></a>
            </div>
          </div>
        </div>
        <div class="col-sm-5 mb-4">
          <div class="card bg-dark text-dark">
            <div class="card-body">
              <i class="fas fa-map-marked-alt fa-3x text-light"></i>
              <h5 class="card-title text-light"> Manage Lands</h5>
              <a href="../view/lands.php" class="btn btn-outline-warning btn-xl"><i class="fas fa-arrow-right "></i> Go to the form >></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    

   
  </div>
  <br>
  <br>
  <div class="col-md-3 d-flex  justify-content-center">
    <div>
      <iframe src="https://calendar.google.com/calendar/embed?src=your-calendar-link" style="border: 0" width="100%" height="300" frameborder="0" scrolling="no"></iframe>
    </div>
  </div>
</div>
</div>

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
                                <h2 style="font-family: 'Times New Roman', serif; font-weight: bold;  ;">Location Analysis</h2>
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
                            <h2 style="font-family: 'Times New Roman', serif; font-weight: bold;  ;">Fertilizer Analysis</h2>
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

    </script>


</body>





<?php
    include_once("../view/footer.php");
    ?>



