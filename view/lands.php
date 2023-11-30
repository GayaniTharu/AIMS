<?php
include_once("../view/navigationBar.php");



$response = isset($_GET["response"]) ? $_GET["response"] : ""; // add user eke response eka link krnwa
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";
$email = isset($_SESSION["otp"]) ? $_SESSION["otp"]["email"] : "";

?>



<!-- content -->
<div class="container-fluid">
     <!-- /////////////////// Top Banner ///////////////////// -->
     <div class="row ">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/1234.jpg');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 7.5vw;">Land Registration</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="farmer_reg.php">Farmer Registration</a> &rarr; Land Registration
            </p>
        </div>
    </div>
    <!-- ///////////////////// Banner End /////////////////////// -->

    <!-- //////////////// Response Alert //////////////////// -->
    <div class="row mt-3">
        <div class="col-sm-8 mx-auto text-center">
            <?php if ($status == "1") { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 style="color: green;"><?php echo $response; ?></h3>
                </div>
            <?php } else if ($status == "0") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 style="color: red;"><?php echo $response; ?></h3>
                </div>
            <?php } ?>
        </div>
    </div>

    </script>
    <!-- //////////////// Response Alert End //////////////////// -->

    <div class="row mt-3 mb-3">

        <h2 class"text-center"><?php echo $response; ?></h2>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="text-danger">* required fields </p>
                    </div>
                    <form id="landform" enctype="multipart/form-data" method="POST" action="../controller/land_controller.php?type=addland"><!--user controller wala case eke thiyen type eka-->
                   
                       
                    <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="nic" class="control-label">NIC <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="nic" id="nic" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="farname" class="control-label">Farmer Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="farname" id="farname" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="landnumber" class="control-label">Land Number <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="landnumber" id="landnumber" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="landsize" class="control-label">Land Size in Acres <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="landsize" id="landsize" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
    <div class="col-sm-2 text-muted">
        <label for="landlocation" class="control-label">Land Location <i class="text-danger">*</i></label>
    </div>
    <div class="col-sm-4 text-muted">
        <select name="landlocation" id="landlocation" class="form-control" required>
            <option value="sooriyawewa">Sooriyawewa</option>
            <option value="meegahajandura">Meegahajandura</option>
            <option value="kiriibbanwewa">Kiri Ibbanwewa</option>
            <option value="morakatiya">Morakatiya</option>
            <option value="yaya7">Yaya7</option>
            <option value="yay12">Yay12</option>
        </select>
    </div>
</div>

                        <!-- Save Button -->

                        <div class="row mt-3">
                            <div class="col-sm-12 text-right">
                                <button type ="submit" name="save" class="btn btn-primary" style="width: 100px; height: 45px;"> Save</button>
                            </div>
                        </div>
                        <!-- <div class="row mt-3">
                            <div class="col-sm-12 text-center">
                                <button type="submit" name="save" class="btn btn-primary">Save</button>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>

    </div>



















<!-- JavaScript code to handle autofill -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $("#nic").on("blur", function() { // Use the blur event when the user moves away from the NIC field
    var nicValue = $(this).val();
    $.ajax({
      url: "../controller/fetch_farname.php", // Replace with the server-side script URL
      method: "POST",
      data: { nic: nicValue },
      success: function(data) {
        $("#farname").val(data); // Update the farname field with the retrieved data
      },
      error: function() {
        // Handle errors if the request fails
      }
    });
  });
});
</script>









<?php
    include_once("../view/footer.php");
    ?>


<script type="text/javascript">
    document.title = "AIMS | Land Registration";


    