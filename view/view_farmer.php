<?php
include_once("../view/navigationBar.php");



$response = isset($_GET["response"]) ? $_GET["response"] : ""; // add user eke response eka link krnwa
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";
$email = isset($_SESSION["otp"]) ? $_SESSION["otp"]["email"] : "";
?>





<?php 
require_once('../common/db.php');
$query = "select * from far_reg";
$result = mysqli_query($con,$query);


require_once '../common/db.php';
require_once '../model/function.php';

$result = display_data();

?>




<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Funda Of Web IT</title>
</head>
<body>

<!-- Add a button for generating PDF -->

<div class="col-md-7">
    <form action="" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" required value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control" placeholder="Search data">
            <button type="submit" class="btn btn-primary mr-2">Search</button>
            <button type="button" class="btn btn-success" onclick="generatePDF()">Generate PDF</button>

        </div>
    </form>
    
</div>


<!-- Add the script for generating PDF -->
<script>
    function generatePDF() {
        // You may need to adjust the path based on your project structure
        var pdfGeneratorUrl = '../controller/generate_pdf.php';
        
        window.open(pdfGeneratorUrl, '_blank');
    }
</script>

        

        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Contact Number</th>
                                <th>NIC</th>
                                <th>Account Number</th>
                                <th>Address 1</th>
                                <th>Address 2</th>
                                <th>Address 3</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $con = mysqli_connect("localhost", "root", "", "aims");

                            if (isset($_GET['search'])) {
                                $filtervalues = $_GET['search'];
                                $query = "SELECT * FROM far_reg WHERE CONCAT(far_nic) LIKE '%$filtervalues%'";
                                $query_run = mysqli_query($con, $query);

                                if ($query_run) {
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $items) {
                                            ?>
                                            <tr>
                                                <td><?= $items['far_fname']; ?></td>
                                                <td><?= $items['far_lname']; ?></td>
                                                <td><?= $items['far_con']; ?></td>
                                                <td><?= $items['far_nic']; ?></td>
                                                <td><?= $items['far_acc']; ?></td>
                                                <td><?= $items['far_add1']; ?></td>
                                                <td><?= $items['far_add2']; ?></td>
                                                <td><?= $items['far_add3']; ?></td>
                                                <td>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="farmer_id" value="<?= $items['far_nic']; ?>">
                                                        <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="9">No Record Found</td>
                                        </tr>
                            <?php
                                    }
                                } else {
                                    echo "Error in query: " . mysqli_error($con);
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['delete_btn'])) {
    $delete_id = $_POST['farmer_id'];

    $delete_query = "DELETE FROM far_reg WHERE far_nic = '$delete_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        echo '<script>alert("Record deleted successfully");</script>';
        header('Location: your_current_page.php'); // Redirect to your current page after deletion
    } else {
        echo '<script>alert("Error deleting record");</script>';
    }
}
?>



</body>



<?php



    include_once("../view/footer.php");
    ?>




<!-- ALTER TABLE fertilizer
DROP FOREIGN KEY fertilizer_ibfk_1;

ALTER TABLE fertilizer
ADD CONSTRAINT fertilizer_ibfk_1 FOREIGN KEY (nic) REFERENCES far_reg(far_nic) ON DELETE CASCADE;






Cascade Deletion:

    You can configure the foreign key constraint to cascade the deletion when a corresponding record in the parent table (far_reg) is deleted.

    For example, if you have a foreign key constraint named fertilizer_ibfk_1, you can modify it to include ON DELETE CASCADE:
 -->