<?php
// Include dompdf library
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Fetch data from your database (replace with your database logic)
$mysqli = new mysqli("localhost", "root", "", "aims");
$sql = "SELECT * FROM fertilizer";
$result = $mysqli->query($sql);

// Create a new Dompdf instance
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

// Load HTML content into Dompdf
$headerHtml = '<html>
<head>
    <style>
        .header {
            text-align: center;
            padding: 20px;
        }
        .header img {
            max-width: 100%;
            height: auto;
        }
        h1 {
            color: #333;
            text-align: center;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px; /* Reduced margin between table and footer */
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 10px; /* Reduced margin-top */
        }
        p {
            font-size: 20px; /* You can adjust the value (in pixels) to set the desired font size */
            line-height: 0.8; /* You can adjust the value to set the desired line height */
        }
        .container {
            margin-top: 20px;
        }
        .container h2 {
            color: #333;
            text-align: center;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Agricultural Information Management System</h1>
        <h3><p>Agrarian Service Center,
        Meegahajandura,
        Hambantota.</p></h3>
        <p>Sooriyawewa, Meegahajadura.</p>
        
        <hr style="border: 1px solid black; margin-top: 5px;"> <!-- Horizontal line -->
    </div>
    <h2>Farmers Fertilizer Usage</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>NIC</th>
            <th>Land Number</th>
            <th>Total Area</th>
            <th>Urea 1(Kg)</th>
            <th>Urea 2(Kg)</th>
            <th>Urea 3(Kg)</th>
            <th>TSP(Kg)</th>
            <th>MOP(Kg)</th>
            <th>ZS(Kg)</th>
        </tr>';

        $result->data_seek(0);

        // Initialize variables to store the sum of each column
        $totalUrea1 = $totalUrea2 = $totalUrea3 = $totalTSP = $totalMOP = $totalZS = 0;
        
        while ($row = $result->fetch_assoc()) {
            $headerHtml .= '<tr>';
            $headerHtml .= '<td>' . $row['nic'] . '</td>';
            $headerHtml .= '<td>' . $row['land_number'] . '</td>';
            $headerHtml .= '<td>' . $row['total_area'] . '</td>';
            $headerHtml .= '<td>' . $row['urea1'] . '</td>';
            $headerHtml .= '<td>' . $row['urea2'] . '</td>';
            $headerHtml .= '<td>' . $row['urea3'] . '</td>';
            $headerHtml .= '<td>' . $row['tsp'] . '</td>';
            $headerHtml .= '<td>' . $row['mop'] . '</td>';
            $headerHtml .= '<td>' . $row['zs'] . '</td>';
            $headerHtml .= '</tr>';
        
            // Calculate the sum for each column
            $totalUrea1 += $row['urea1'];
            $totalUrea2 += $row['urea2'];
            $totalUrea3 += $row['urea3'];
            $totalTSP += $row['tsp'];
            $totalMOP += $row['mop'];
            $totalZS += $row['zs'];
        }
        
        // Add a row at the end with the calculated sums
        $headerHtml .= '<tr>';
        $headerHtml .= '<td colspan="3"><strong>Total</strong></td>';
        $headerHtml .= '<td><strong>' . $totalUrea1 . '</strong></td>';
        $headerHtml .= '<td><strong>' . $totalUrea2 . '</strong></td>';
        $headerHtml .= '<td><strong>' . $totalUrea3 . '</strong></td>';
        $headerHtml .= '<td><strong>' . $totalTSP . '</strong></td>';
        $headerHtml .= '<td><strong>' . $totalMOP . '</strong></td>';
        $headerHtml .= '<td><strong>' . $totalZS . '</strong></td>';
        $headerHtml .= '</tr>';
        
        $headerHtml .= '</table></div></body></html>';


$headerHtml .= '</table></div></body></html>';
// Define your footer HTML
$generatedDate = date("Y-m-d "); // Get the current date and time
$footerHtml = '<div class="footer">
    <hr style="border: 1px solid black; margin-top: 5px;"> <!-- Horizontal line -->
    <p>Printed Date: ' . $generatedDate . '</p>
    <p>© ' . date("Y") . ' Agricultural Information Management System. All rights reserved.</p>
</div>';

$headerHtml .= $footerHtml . '</body></html>';

$dompdf->loadHtml($headerHtml);

// Set paper size (A4 is the default)
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream();
?>
