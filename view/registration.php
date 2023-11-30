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
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 7.5vw;">User Registration</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home2.php">Home</a> &rarr; Registration
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
    <!-- //////////////// Response Alert End //////////////////// -->

    <div class="row mt-3 mb-3">

        <h2 class"text-center"><?php echo $response; ?></h2>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="text-danger">* required fields </p>
                    </div>
                    <form id="signupform" enctype="multipart/form-data" method="POST" action="../controller/user_controller.php?type=adduser"><!--user controller wala case eke thiyen type eka-->
                   
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Email <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="email" name="email" id="email" class="form-control"  required autocomplete="off">
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Service Id <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="id" id="id" class="form-control" required>
                            </div>
                        <!--fname lname-->
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">First Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="fname" id="fname" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Last Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="lname" id="lname" class="form-control" required>
                            </div>
                        </div>
                        <!--contact number-->
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Contact Number <i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">0</span>
                                    </div>
                                    <input type="number" name="con" id="con" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">NIC <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted ">
                                <input type="text" name="nic" id="nic" class="form-control" required> <!--required dnne aniwarenma ewa fill wenna ona-->
                                <h5 id="user_response" class="text-danger"></h5>  <!--nic eka db eke kalin thiyeda blnna, text danger kiynne red color eka-->
                            </div>
                        </div>
                        <!--gender-->
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Gender <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio1" name="gender" class="custom-control-input" value="M">
                                    <label class="custom-control-label" for="customRadio1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio2" name="gender" class="custom-control-input" value="F">
                                    <label class="custom-control-label" for="customRadio2">Female</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            

                        <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Position<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-3 text-muted pr-0 mt-1 mt-sm-0">
                                
                            <select class="form-control" id="pos">
                                    <option>DO</option>
                                    <option>People's Bank</option>
                                    <option>Sampath Bank</option>
                                    <option>HNB</option>
                                    
                                </select>
                            </div>


                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label"><i class="text-danger"></i></label>
    
                                
                               
                                </div> 
                            </div>
                        <!--address-->
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Address <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-3 text-muted pr-0 mt-1 mt-sm-0">
                                <input type="text" name="add1" id="add1" class="form-control " placeholder="Street Address 01" required>
                            </div>
                            <div class="col-sm-3 text-muted pr-0 mt-1 mt-sm-0">
                                <input type="text" name="add2" id="add2" class="form-control " placeholder="Street Address 02" required>
                            </div>
                            <div class="col-sm-3 text-muted pr-0 mt-1 mt-sm-0">
                                <input type="text" name="add3" id="add3" class="form-control" placeholder="City" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">User Image</label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="file" name="uimg" id="uimg" class="form-control-file" onchange="readURL(this);">
                                <!-- Image Preview -->
                                <div>
                                    <img id="prev_img" alt="">
                                </div>
                                <!-- Preview End -->
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-4 text-muted">
                                <button id="submit" type="submit" class="btn btn-block button text-white text-uppercase btn btn-primary"><i class="fad fa-save"></i>&nbsp; &nbsp; Register</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
    document.title = "AIMS | User Registration";
</script>
<script src="../js/user_valid.js"></script>  <!--user_valid.js eka link krnwa meka </body> ekata kalin hari </head> ekata anthimata hari krnna ona -->


<?php
    include_once("../view/footer.php");
    ?>
    
    <script>
    function clearForm() {
        document.getElementById("signupform").reset();
    }

    // Call the clearForm function when the page loads
    window.onload = clearForm;
</script>
