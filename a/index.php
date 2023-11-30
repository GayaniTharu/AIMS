<!DOCTYPE html>
<html>
<head>
   
    <!-- Include jQuery and Bootstrap CSS/JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    <!-- DataTables CSS/JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- X-Editable CSS/JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>

    <!-- Include the Bootstrap Modal for Calculator -->
    <!-- Add your modal code here -->

</head>
<body>
<div class="container">
    <h3 align="center">Fertilizer Details of yala kanna</h3>
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">Fertilizer given Details

            <!-- Calculator Button -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#calculatorModal">Open Calculator</button>

          	<!--button code start-->
<body>
	<!--button style css code-->
<style>
  .abc {
    text-align: right;
    margin-bottom: 10px;
  }

  .generate-pdf-button {
    background-color: lightcoral; /* Green background color */
    color: white; /* White text color */
    border: none; /* No border */
    padding: 10px 20px; /* Padding */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Cursor on hover */
  }

  .generate-pdf-button:hover {
    background-color: darkmagenta; /* Darker green on hover */
  }
</style>

<form method="post" action="generate_pdf.php" style="text-align: right;">
    <button type="submit" name="generate_pdf" class="generate-pdf-button">Generate PDF</button>
</form>

        </div>
        <div class="panel-body">
            <!-- Your DataTable and other content here -->
        </div>
    </div>
</div>

<!-- Calculator Modal -->
<div class="modal fade" id="calculatorModal" tabindex="-1" role="dialog" aria-labelledby="calculatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 12cm; height: 8cm;">
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
                        <p><strong>Urea 1:</strong> <span id="urea1Amount"></span> kg</p>
                        <p><strong>Urea 2:</strong> <span id="urea2Amount"></span> kg</p>
                        <p><strong>Urea 3:</strong> <span id="urea3Amount"></span> kg</p>
                    </div>
                    <div class="col-sm-6">
                        <p><strong>TSP:</strong> <span id="tspAmount"></span> kg</p>
                        <p><strong>MOP:</strong> <span id="mopAmount"></span> kg</p>
                        <p><strong>ZS:</strong> <span id="zsAmount"></span> kg</p>
                    </div>
    </div>
</div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript code to handle form submission and conversion -->
<script>
    $(document).ready(function () {
        const resultElement = $("#calculatorResult");
        const urea1AmountElement = $("#urea1Amount");
        const urea2AmountElement = $("#urea2Amount");
        const urea3AmountElement = $("#urea3Amount");
        const tspAmountElement = $("#tspAmount");
        const mopAmountElement = $("#mopAmount");
        const zsAmountElement = $("#zsAmount");

        $("#calculateButton").on("click", function (e) {
            e.preventDefault(); // Prevent form submission

            const inputAmount = parseFloat($("#inputAmount").val());
            const selectUnit = $("#selectUnit").val();

            // Conversion logic (1 acre = 2.47105 hectares, 1 perch = 0.000206611 hectare)
            let conversionFactor;
            if (selectUnit === "acres") {
                conversionFactor = 2.47105;
                 
            } else {
                conversionFactor = 0.000206611;
            }

            const hectareAmount = inputAmount * conversionFactor;

            // Calculate Urea1, Urea2, Urea3, TSP, MOP, and ZS based on per hectare values
            const urea1PerHectare = 50; // 50 kg per hectare
            const urea2PerHectare = 75; // 75 kg per hectare
            const urea3PerHectare = 65; // 65 kg per hectare
            const tspPerHectare = 55;   // 55 kg per hectare
            const mopPerHectare = 60;   // 60 kg per hectare
            const zsPerHectare = 5;    // 5 kg per hectare

            const urea1Amount = hectareAmount * urea1PerHectare;
            const urea2Amount = hectareAmount * urea2PerHectare;
            const urea3Amount = hectareAmount * urea3PerHectare;
            const tspAmount = hectareAmount * tspPerHectare;
            const mopAmount = hectareAmount * mopPerHectare;
            const zsAmount = hectareAmount * zsPerHectare;

            // Display the result and fertilizer amounts
            resultElement.text(`${inputAmount} ${selectUnit} is approximately ${hectareAmount.toFixed(4)} hectares.`);
            urea1AmountElement.text(urea1Amount.toFixed(2));
            urea2AmountElement.text(urea2Amount.toFixed(2));
            urea3AmountElement.text(urea3Amount.toFixed(2));
            tspAmountElement.text(tspAmount.toFixed(2));
            mopAmountElement.text(mopAmount.toFixed(2));
            zsAmountElement.text(zsAmount.toFixed(2));
        });
    });
</script>

</body>
</html>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table to PDF</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        // Function to generate PDF from HTML table
        function generatePDF() {
            // Create a new jsPDF instance
            const pdf = new jsPDF();

            // Add a title to the PDF (optional)
            pdf.text("Table to PDF", 10, 10);

            // Get the table element
            const table = document.getElementById("myTable");

            // Convert the table to a PDF
            pdf.autoTable({ html: table });

            // Save the PDF or open in a new tab (optional)
            pdf.save("table.pdf");
        }
    </script>
    <style>
    /* CSS */
.editing-cell {
    background-color: yellow;
}

</style>
														<!--button code end-->
		</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="user_data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Farmer ID</th>
                            <th>First Name</th>
                            <th>NIC</th>
                            <th>Total Area</th>
                            <th>Grow Area</th>
                            <th>Urea 1</th>
                            <th>Urea 2</th>
                            <th>Urea 3</th>
                            <th>TSP</th>
                            <th>MOP</th>
                            <th>Zs</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<br />
<br />
<script type="text/javascript" language="javascript">
$(document).ready(function(){
    var dataTable = $('#user_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order":[],
        "ajax":{
            url:"fetch.php",
            type:"POST",
        },
        createdRow:function(row, data, rowIndex)
        {
            $.each($('td', row), function(colIndex){
                var columnName = ['grow_area', 'urea1', 'urea2', 'urea3', 'tsp', 'mop', 'zs'][colIndex - 4];
                $(this).attr('data-name', columnName);
                $(this).attr('class', columnName);
                $(this).attr('data-type', 'text');
                $(this).attr('data-pk', data[0]);
            });
        }
    });

    // Initialize X-Editable for specific editable cells
    $('#user_data').editable({
        container:'body',
        selector:'td.grow_area, td.urea1, td.urea2, td.urea3, td.tsp, td.mop, td.zs',
        url:'update.php',
        title:function(){
            return $(this).data('name');
        },
        type:'POST',
        validate:function(value){
            if($.trim(value) == '')
            {
                return 'This field is required';
            }
        }
    });
	   // Add the $.ajax() code here
	   $.ajax({
        url: "fetch.php", // This should match the URL you use for DataTables
        type: "POST",
        success: function(response) {
            console.log(response); // Log the JSON response to the browser console
            // Additional code if needed
        },
        // Additional options if needed
    });

    // Initialize X-Editable for specific editable cells
$('#user_data').editable({
    container: 'body',
    selector: 'td.grow_area, td.urea1, td.urea2, td.urea3, td.tsp, td.mop, td.zs',
    url: 'update.php',
    title: function () {
        return $(this).data('name');
    },
    type: 'POST',
    validate: function (value) {
        if ($.trim(value) == '') {
            return 'This field is required';
        }
    },
    success: function (response, newValue) {
        // Remove the 'editing-cell' class when editing is done
        $(this).removeClass('editing-cell');
    },
    // Callback function when editing starts
    beforeSend: function () {
        // Add the 'editing-cell' class when editing starts
        $(this).addClass('editing-cell');
    }
});

});
</script>

<button type="button" class="btn btn-primary btn-lg" href="../a/cal.php" >Large button</button>
</body>
</html>

