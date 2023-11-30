<?php
include_once("../view/navigationbarAI.php");



$response = isset($_GET["response"]) ? $_GET["response"] : ""; // add user eke response eka link krnwa
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";
$email = isset($_SESSION["otp"]) ? $_SESSION["otp"]["email"] : "";
?>



<!-- content -->
<div class="container-fluid">
    <!-- /////////////////// Top Banner ///////////////////// -->
    <div class="row ">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/1234.jpg');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 7.5vw;">Manage News</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home2.php">Admin Home</a> &rarr; Add News
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
        <h2 class="text-center"><?php echo $response; ?></h2>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="text-danger">* required fields</p>
                    </div>
                    <form id="landform" enctype="multipart/form-data" method="POST" action="../controller/news_controller.php?type=addnews">
                        <!-- User controller wala case eke thiyen type eka -->

                        <div class="row mt-3">
                            <div class="col-sm-5 text-muted">
                                <label for="title" class="control-label"><i class="fas fa-bolt"></i> Title <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-12 text-muted">
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-5 text-muted">
                                <label for="descriptions" class="control-label"><i class="fas fa-align-left"></i> Description <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-12 text-muted">
                                <textarea type="text" name="descriptions" id="descriptions" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <br>

                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="uimg" class="control-label"><i class="fas fa-image"></i> Images</label>
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

                        <!-- Save Button -->
                        <div class="row mt-3">
                        <div class="col-sm-12 text-right">
                                <button type="submit" name="save" class="btn btn-primary"><i class="fas fa-plus"></i> Save News</button>
                            </div>
                        <!-- <div class="row mt-3">
                            <div class="col-sm-12 text-center">
                                <button type="submit" name="save" class="btn btn-primary"><i class="fas fa-plus"></i> Save</button>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "aims";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    <?php


    $sql = "SELECT id, uimg, title FROM add_news ORDER BY id DESC LIMIT 5"; // Order by the id column in descending order (latest first) and limit to 5 records
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="container-fluid text-center p-0">';
        echo '<div class="d-flex justify-content-center">'; // Center the table contents
        echo '<table><tr>';

        while ($row = $result->fetch_assoc()) {
            $news_id = $row["id"];
            $uimg = $row["uimg"];
            $title = $row["title"];

            // Define the path to the image directory
            $imageDirectory = "../image/newsimg/";

            // Generate the full image URL by concatenating the directory and file name
            $imageUrl = $imageDirectory . $uimg;

            // Generate a new card for each news item within a table cell
            echo '<td>';
            echo '<div class="card card-hover" style="width: 18rem;">'; // Added "card-hover" class for hover effect
            echo '<img class="card-img-top" style="height: 200px; object-fit: cover;" src="' . $imageUrl . '" alt="Card image cap">';
            echo '<div class="card-body" style="height: 200px;">';
            echo '<h5 class="card-title">' . $title . '</h5>';
            // echo '<a href="#" class="btn btn-info" style="margin-right: 5px;">Show More</a>';
            echo '<a href="#" class="btn btn-danger delete-news" data-news-id="' . $news_id . '">Delete</a>';

            echo '</div>';
            echo '</div>';
            echo '</td>';
        }

        echo '</tr></table>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "No data available in the database.";
    }

    ?>
    <style>
        /* Add this CSS to your stylesheet */
        .card-hover:hover {
            transform: translateY(-5px);
            /* Move the card up by 5 pixels on hover */
            transition: transform 0.3s ease;
            /* Add a smooth transition effect */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            /* Add a box shadow on hover */
        }
    </style>

    <!-- Add a modal for confirmation -->
    <div id="confirmModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this news item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle delete button clicks
        $(document).on('click', '.delete-news', function() {
            var newsId = $(this).data('news-id');
            $('#confirmDelete').data('news-id', newsId);
            $('#confirmModal').modal('show');
        });

        // Handle confirmation delete button click
        $('#confirmDelete').on('click', function() {
            var newsId = $(this).data('news-id');

            // Send an AJAX request to delete the news
            // Send an AJAX request to delete the news
            $.ajax({
                url: 'delete_news.php', // Updated to point to delete_news.php
                type: 'POST',
                data: {
                    'news_id': newsId
                },
                success: function(response) {
                    console.log(response);
                    // Reload the page to update the news list
                    location.reload();
                },
                error: function(error) {
                    console.error(error);
                }
            });

        });
    </script>





    <?php
    include_once("../view/footer.php");
    ?>


    <script type="text/javascript">
        document.title = "AIMS | Add News";