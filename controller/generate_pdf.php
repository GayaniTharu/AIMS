<?php
require_once('../vendor/TCPDF-main/tcpdf.php');

// Create a TCPDF object
$pdf = new TCPDF();
$pdf->SetAutoPageBreak(true, 10);

// Add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

$header = array('First Name', 'Last Name', 'Contact Number', 'NIC', 'Account Number', 'Address 1', 'Address 2', 'Address 3');
$data = array();

// Database connection
$con = mysqli_connect("localhost", "root", "", "aims");

if ($con) {
    // Fetch data from the database
    $query = "SELECT * FROM far_reg";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $data[] = array(
                $row['far_fname'],
                $row['far_lname'],
                $row['far_con'],
                $row['far_nic'],
                $row['far_acc'],
                $row['far_add1'],
                $row['far_add2'],
                $row['far_add3']
            );
        }
    }

    // Set colors and formatting for the table
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(128, 128, 128);

    // Add a table header
    foreach ($header as $col) {
        $pdf->Cell(30, 10, $col, 1);
    }
    $pdf->Ln();

    // Add table data
    foreach ($data as $row) {
        foreach ($row as $col) {
            $pdf->Cell(30, 10, $col, 1);
        }
        $pdf->Ln();
    }

    // Output the PDF to the browser
    $pdf->Output('far_reg_data.pdf', 'I');

    // Close the database connection
    mysqli_close($con);
} else {
    echo "Connection to the database failed.";
}
?>
