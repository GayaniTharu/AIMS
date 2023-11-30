<?php
include_once("../view/navigationBar.php");

// Assuming you have a database connection established
$mysqli = new mysqli("localhost", "root", "", "aims");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch data from the "fertilizer" table
$sql = "SELECT * FROM fertilizer";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include jQuery and Bootstrap CSS/JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables CSS/JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid">
     <!-- /////////////////// Top Banner ///////////////////// -->
     <div class="row ">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/1234.jpg');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 7.5vw;">Manage Fertilizer</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="../view/home2.php">Admin Home</a> &rarr; Manage Fertilizer
            </p>
        </div>
    </div>
<div class="container">
    <br >
    <div class="panel panel-default">
        <div class="panel-heading mb-3">
            <!-- Calculator Button -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#calculatorModal">Fertilizer Calculator</button>
        </div>
        <form method="post" action="generate_pdf.php" style="text-align: right;">
    <button type="submit" name="generate_pdf" class="generate-pdf-button">Generate PDF</button>
</form>
        <div class="panel-body">
            <!-- Your DataTable and other content here -->
            <!-- Initialize DataTable with searching and filtering -->
            <table id="fertilizerTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIC</th>
                        <th>Land Number</th>
                        <th>Total Area</th>
                        <th>Urea 1 (Kg)</th>
                        <th>Urea 2 (Kg)</th>
                        <th>Urea 3 (Kg)</th>
                        <th>TSP (Kg)</th>
                        <th>MOP (Kg)</th>
                        <th>ZS (Kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the fetched data and populate the table
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nic'] . "</td>";
                        echo "<td>" . $row['land_number'] . "</td>";
                        echo "<td>" . $row['total_area'] . "</td>";
                        echo "<td>" . $row['urea1'] . "</td>";
                        echo "<td>" . $row['urea2'] . "</td>";
                        echo "<td>" . $row['urea3'] . "</td>";
                        echo "<td>" . $row['tsp'] . "</td>";
                        echo "<td>" . $row['mop'] . "</td>";
                        echo "<td>" . $row['zs'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Calculator Modal -->
<div class="modal fade" id="calculatorModal" tabindex="-1" role="dialog" aria-labelledby="calculatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 16cm; height: 8cm;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calculatorModalLabel">Land Area Converter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Calculator Form -->
                <form id="calculatorForm">
                    <div class="form-group">
                        <label for="nic">NIC</label>
                        <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter NIC">
                    </div>
                    <div class="form-group">
    <label for="landnumber">Land Number</label>
    <select class="form-control" id="landnumber" name="landnumber">
        <!-- Land numbers will be dynamically populated here -->
    </select>
</div>

                    <div class="form-group">
                        <label for="inputAmount">Enter Amount (in Perches or Acres)</label>
                        <input type="number" class="form-control" id="inputAmount" name="inputAmount" placeholder="Enter Amount">
                    </div>
                    <div class="form-group">
                        <label for="selectUnit">Select Unit</label>
                        <select class="form-control" id="selectUnit" name="selectUnit">
                            <option value="perches">Perches</option>
                            <option value="acres">Acres</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <!-- Calculator Result Display Area -->
                <button type="button" id="calculateButton" class="btn btn-primary">Convert to Hectares</button>
            </div>
            <div class="modal-body">
                <h4>Result:</h4>
                <p id="calculatorResult">Converted Hectare Amount Will Appear Here</p>
                <!-- Fertilizer Results -->
                <!-- Urea and TSP Results -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Urea 1(Kg):</strong>
                                <input type="text" class="form-control urea1-amount" readonly>
                               
                            </p>
                            <p><strong>Urea 2(Kg):</strong>
                                <input type="text" class="form-control urea2-amount" readonly>
                               
                            </p>
                            <p><strong>Urea 3(Kg):</strong>
                                <input type="text" class="form-control urea3-amount" readonly>
                                
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>TSP(Kg):</strong>
                                <input type="text" class="form-control tsp-amount" readonly>
                                
                            </p>
                            <p><strong>MOP (Kg):</strong>
                                <input type="text" class="form-control mop-amount" readonly>
                                
                            </p>
                            <p><strong>ZS(Kg):</strong>
                                <input type="text" class="form-control zs-amount" readonly>
                               
                            </p>



                        </div>
                        <button type="button" id="addbutton" class="addbutton" data-fertilizer="addbutton">
                            <i class="fa fa-copy"></i> Add
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- JavaScript code to handle form submission and conversion -->
<script>


// Update the JavaScript code within the calculatorModal modal

// ... (previous code)

// Fetch land numbers based on NIC
function fetchLandNumbersByNIC(nic) {
    $.ajax({
        url: "../a/your_server_endpoint.php", // Replace with the actual URL to your_server_endpoint.php
        method: "POST",
        data: { nic: nic },
        success: function (response) {
            const data = JSON.parse(response);
            const landNumberSelect = $("#landnumber");

            // Clear the select box
            landNumberSelect.empty();

            if (data.landNumbers && data.landNumbers.length > 0) {
                // Populate the select box with fetched land numbers
                data.landNumbers.forEach(function (landNumber) {
                    landNumberSelect.append(new Option(landNumber, landNumber));
                });
            } else {
                // Handle the case where no land numbers are found
                landNumberSelect.append(new Option("No land numbers found", ""));
            }
        },
        error: function () {
            alert("Error fetching land numbers from the server.");
        },
    });
}

$("#nic").on("blur", function () {
    const nic = $(this).val();
    fetchLandNumbersByNIC(nic);
});



// Event listener for the calculator modal hidden event
$("#calculatorModal").on("hidden.bs.modal", function () {
    // Clear input values and calculator result when the modal is closed
    clearInputValues();
});

// Function to clear input values
function clearInputValues() {
    $("#nic").val("");
    $("#landnumber").val("");
    $("#inputAmount").val("");
    $("#selectUnit").val("perches");
    $(".form-control.urea1-amount").val("");
    $(".form-control.urea2-amount").val("");
    $(".form-control.urea3-amount").val("");
    $(".form-control.tsp-amount").val("");
    $(".form-control.mop-amount").val("");
    $(".form-control.zs-amount").val("");
    $("#calculatorResult").text("Converted Hectare Amount Will Appear Here");
}

    // Function to fetch inputAmount from the server based on NIC
    $(document).ready(function () {
        const resultElement = $("#calculatorResult");

        // Clear input values on page load
        clearInputValues();

        function fetchInputAmountByNIC(nic) {
            // Make an AJAX request to your server to get the inputAmount and landnumber based on the NIC
            $.ajax({
                url: "../a/controller/your_server_endpoint.php", // Replace with your server endpoint
                method: "POST",
                data: { nic: nic },
                success: function (response) {
                    // Assuming the response is a JSON object with the inputAmount and landnumber
                    const data = JSON.parse(response);
                    if (data.land_size) {
                        $("#inputAmount").val(data.land_size);
                        $("#landnumber").val(data.landnumber);
                    } else {
                        // Handle the case where data is not found for the given NIC
                        alert("Data not found for this NIC.");
                    }
                },
                error: function () {
                    alert("Error fetching data from the server.");
                },
            });
        }

        // Event listener for the NIC input field
        $("#nic").on("blur", function () {
            const nic = $(this).val();
            fetchInputAmountByNIC(nic);
        });

        $("#calculateButton").on("click", function (e) {
            e.preventDefault(); // Prevent form submission

            const inputAmount = parseFloat($("#inputAmount").val());
            const selectUnit = $("#selectUnit").val();

            // Conversion logic (1 acre = 2.47105 hectares, 1 perch = 0.000206611 hectare)
            let conversionFactor;
            if (selectUnit === "acres") {
                conversionFactor = 2.471;
            } else {
                conversionFactor = 0.000206611;
            }

            const hectareAmount = inputAmount * conversionFactor;

            // Calculate Urea1, Urea2, Urea3, TSP, MOP, and ZS based on per hectare values
            const urea1PerHectare = 50; // 50 kg per hectare
            const urea2PerHectare = 75; // 75 kg per hectare
            const urea3PerHectare = 65; // 65 kg per hectare
            const tspPerHectare = 55; // 55 kg per hectare
            const mopPerHectare = 60; // 60 kg per hectare
            const zsPerHectare = 5; // 5 kg per hectare

            const urea1Amount = hectareAmount * urea1PerHectare;
            const urea2Amount = hectareAmount * urea2PerHectare;
            const urea3Amount = hectareAmount * urea3PerHectare;
            const tspAmount = hectareAmount * tspPerHectare;
            const mopAmount = hectareAmount * mopPerHectare;
            const zsAmount = hectareAmount * zsPerHectare;

            // Display the result and set the calculated fertilizer amounts in the textboxes
            resultElement.text(${inputAmount} ${selectUnit} is approximately ${hectareAmount.toFixed(4)} hectares.);
            $(".urea1-amount").val(urea1Amount.toFixed(2));
            $(".urea2-amount").val(urea2Amount.toFixed(2));
            $(".urea3-amount").val(urea3Amount.toFixed(2));
            $(".tsp-amount").val(tspAmount.toFixed(2));
            $(".mop-amount").val(mopAmount.toFixed(2));
            $(".zs-amount").val(zsAmount.toFixed(2));
        });

        // Add button click event handler
        $(document).ready(function () {
    const resultElement = $("#calculatorResult");
    let inputAmount; // Define inputAmount here

    // Rest of your code...

    // Click event handler for the "Add" button
   $(document).ready(function () {
    const resultElement = $("#calculatorResult");
    let inputAmount; // Define inputAmount here

    // Rest of your code...

    // Click event handler for the "Add" button
    $(".addbutton").on("click", function () {
        const nic = $("#nic").val();
        const landnumber = $("#landnumber").val();
        const urea1 = $(".urea1-amount").val();
        const urea2 = $(".urea2-amount").val();
        const urea3 = $(".urea3-amount").val();
        const tsp = $(".tsp-amount").val();
        const mop = $(".mop-amount").val();
        const zs = $(".zs-amount").val();

        // Set the value of inputAmount here
        inputAmount = parseFloat($("#inputAmount").val());

        $.ajax({
            url: "../a/controller/insert_fertilizer.php",
            method: "POST",
            data: {
                nic: nic,
                landnumber: landnumber,
                inputAmount: inputAmount, // Use the previously defined inputAmount
                urea1: urea1,
                urea2: urea2,
                urea3: urea3,
                tsp: tsp,
                mop: mop,
                zs: zs
            },
            success: function (response) {
                alert(response); // Show a success message
            },
            error: function () {
                alert("Error inserting data.");
            },
        });
    });

    $(document).ready(function () {
    

    // Initialize DataTable with searching and filtering
    var dataTable = $('#fertilizerTable').DataTable({
        // your DataTable configuration options here
    });

    // Search button click event handler
    $('#searchButton').click(function () {
        var searchValue = $('#searchNIC').val();

        // Use DataTables search API to filter the table by NIC
        dataTable.search(searchValue).draw();
    });
});

});

});
    });



    
</script>

<!-- JavaScript code to handle form submission and conversion -->
<script>


// Fetch land numbers based on NIC
function fetchLandNumbersByNIC(nic) {
    $.ajax({
        url: "../a/your_server_endpoint.php", // Replace with the actual URL to your_server_endpoint.php
        method: "POST",
        data: { nic: nic },
        success: function (response) {
            const data = JSON.parse(response);
            const landNumberSelect = $("#landnumber");

            // Clear the select box
            landNumberSelect.empty();

            if (data.landNumbers && data.landNumbers.length > 0) {
                // Populate the select box with fetched land numbers
                data.landNumbers.forEach(function (landNumber) {
                    landNumberSelect.append(new Option(landNumber, landNumber));
                });
            } else {
                // Handle the case where no land numbers are found
                landNumberSelect.append(new Option("No land numbers found", ""));
            }
        },
        error: function () {
            alert("Error fetching land numbers from the server.");
        },
    });
}

function fetchTotalAreaByLandNumber(landnumber) {
        $.ajax({
            url: "../a/your_server_endpoint_for_total_area.php", // Replace with the actual URL for fetching total_area
            method: "POST",
            data: { landnumber: landnumber },
            success: function (response) {
                const data = JSON.parse(response);

                if (data.totalArea) {
                    // Populate the inputAmount field with the fetched total_area
                    $("#inputAmount").val(data.totalArea);
                } else {
                    // Handle the case where total_area is not found for the given landnumber
                    alert("Total area not found for this landnumber.");
                }
            },
            error: function () {
                alert("Error fetching data from the server.");
            },
        });
    }

    // Event listener for the NIC input field
    $("#nic").on("blur", function () {
        const nic = $(this).val();
        fetchLandNumbersByNIC(nic);
    });

    // Event listener for the landnumber select box
    $("#landnumber").on("change", function () {
        const selectedLandNumber = $(this).val();
        fetchTotalAreaByLandNumber(selectedLandNumber);
    });

// ... (rest of your code)

</script>

</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summation Table</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
      
        .container {
            margin-top: 20px;
        }

        h3 {
            color: #007bff;
        }

        #summation_table {
            width: 100%;
            margin-top: 20px;
            background-color: #ffffff;
        }

        #summation_table th,
        #summation_table td {
            padding: 12px;
            text-align: center;
        }

        #summation_table thead {
            background-color: #007bff;
            color: #ffffff;
        }

        #summation_table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #summation_table tbody tr:hover {
            background-color: #cce5ff;
        }

        #pie_chart_container {
            text-align: center;
            margin-top: 20px;
        }

       
    </style>
</head>
<body>
<h3 style="color: #007bff; text-align: center;">Summary of Fertilizer</h3>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Table -->
                <div class="table-responsive">
               
                    <table id="summation_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Sum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Urea 1</td>
                                <td id="urea1_sum"></td>
                            </tr>
                            <tr>
                                <td>Urea 2</td>
                                <td id="urea2_sum"></td>
                            </tr>
                            <tr>
                                <td>Urea 3</td>
                                <td id="urea3_sum"></td>
                            </tr>
                            <tr>
                                <td>TSP</td>
                                <td id="tsp_sum"></td>
                            </tr>
                            <tr>
                                <td>MOP</td>
                                <td id="mop_sum"></td>
                            </tr>
                            <tr>
                                <td>Zs</td>
                                <td id="zs_sum"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Pie Chart -->
                <div id="pie_chart_container">
                    <canvas id="pie_chart_canvas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch and update the summation table
            $.ajax({
                url: '../a/summation.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.data) {
                        const summationData = response.data[0];

                        // Update the summation table
                        $("#urea1_sum").text(summationData.urea1_sum);
                        $("#urea2_sum").text(summationData.urea2_sum);
                        $("#urea3_sum").text(summationData.urea3_sum);
                        $("#tsp_sum").text(summationData.tsp_sum);
                        $("#mop_sum").text(summationData.mop_sum);
                        $("#zs_sum").text(summationData.zs_sum);

                        // Create and display the pie chart
                        var pieChartCanvas = document.getElementById('pie_chart_canvas').getContext('2d');
                        var pieChart = new Chart(pieChartCanvas, {
                            type: 'pie',
                            data: {
                                labels: Object.keys(summationData).slice(1), // Exclude "total_area"
                                datasets: [{
                                    data: Object.values(summationData).slice(1),
                                    backgroundColor: [
                                        'red',
                                        'orange',
                                        'yellow',
                                        'green',
                                        'blue',
                                        'indigo',
                                        'violet'
                                    ],
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                legend: {
                                    display: true,
                                    position: 'right',
                                }
                            }
                        });
                    } else {
                        // Handle error or display a message
                        console.error('Error fetching summation data');
                    }
                },
                error: function() {
                    console.error('Error fetching summation data');
                }
            });
        });
    </script>
</body>
</html>

</body>
</html>
<?php
    include_once("../view/footer.php");
    ?>




<!-- Your JavaScript code here -->

</body>
</html>

<?php
// Close the database connection
$mysqli->close();
?>