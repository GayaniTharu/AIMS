<?php
ob_start(); // Start output buffering

include_once("../view/navigationBar.php");

ob_end_flush(); // Send the output to the browser
?>

<?php
// Establish a database connection using PDO (modify this based on your database configuration)
$servername = "localhost";
$username = "root";
$password = "";
$database = "aims";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Replace $id with the actual user ID you want to display
$id = "abe1234"; // Replace this with the user ID you want to display

// Retrieve the user's information from the database
$sql = "SELECT user_id, user_fname, user_lname, user_con, user_nic, user_gender, user_add1, user_add2, user_add3, user_img FROM user_reg WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<!-- Display User Profile -->
<div class="container">
    <div class="user-profile">
        <h1>User Profile</h1>
        <div class="user-info">
            <img src="../image/userimg/<?php echo $user["user_img"]; ?>" alt="User Image" class="user-avatar">
            <p class="welcome-message">Welcome, <?php echo $user["user_fname"]; ?></p>
            <p class="user-name">Name: <?php echo $user["user_fname"] . ' ' . $user["user_lname"]; ?></p>
            <p class="user-contact">Contact Number: <?php echo $user["user_con"]; ?></p>
            <p class="user-nic">NIC: <?php echo $user["user_nic"]; ?></p>
            <p class="user-gender">Gender: <?php echo ($user["user_gender"] == 'M') ? 'Male' : 'Female'; ?></p>
            <p class="user-address">Address: <?php echo $user["user_add1"] . ', ' . $user["user_add2"] . ', ' . $user["user_add3"]; ?></p>
        </div>
    </div>
</div>

<style>
    .container {
        display: flex;
        justify-content: flex-start; /* Move content to the right */
        align-items: center;
        height: 100vh;
        max-width: 80%; /* Adjust the maximum width to your desired size (in percentage or pixels) */
        margin: 0 auto; /* Center the container horizontally */
    }



    .user-profile {
        background-color: #f7f7f7;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        max-width: 400px;
    }

    .user-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 10px;
        border: 2px solid #007BFF;
    }

    .welcome-message {
        font-size: 24px;
        font-weight: bold;
    }

    .user-name,
    .user-contact,
    .user-nic,
    .user-gender,
    .user-address {
        font-size: 18px;
        margin: 10px 0;
    }
</style>



<div class="row mt-3 mb-3">

<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div>
                <p class="text-danger">* required fields </p>
            </div>
            <form id="signupform" enctype="multipart/form-data" method="POST" action="change_password.php">
           
               
            
         
                <!--password-->
                <div class="row mt-8">
                    <div class="col-sm-4 text-muted">
                        <label for="" class="control-label">New password <i class="text-danger">*</i></label>
                    </div>
                    <div class="col-sm-8 text-muted">
                        <div class="input-group">
                            <input type="password" name="pw" id="pw" class="form-control" required minlength="6">
                            <div style="cursor: pointer;" class="input-group-append" id="pw_append">
                                <span class="input-group-text">
                                    <i id="pw_icon" class="fas fa-eye"></i>  <!--fas fa-eye dnne eye mark eka dnna -->
                                </span>
                            </div>
                        </div>
                        <div class="progress" style="width: 90%;">
                            <div id="progressBar" class="progress-bar" role="progressbar"></div>
                        </div>
                    </div>
                   
                </div>
            
                <div class="row mt-3">
                <div class="col-sm-4 text-muted">
                        <label for="" class="control-label">Confirm Password <i class="text-danger">*</i></label><!--confirm ekata name ekak ona na eka db ekata pass wenne na js ekata witharai -->
                    </div>
                    <div class="col-sm-8 text-muted">
                        <div class="input-group">
                            <input type="password" name="cpw" id="cpw" class="form-control" value="" required minlength="6">
                            <div style="cursor: pointer;" class="input-group-append" id="cpw_append">
                                <span class="input-group-text">
                                    <i id="cpw_icon" class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-sm-4 text-muted">
                        <button id="submit" type="submit" class="btn btn-block button text-white text-uppercase btn btn-primary"><i class="fad fa-save"></i>&nbsp; &nbsp; Change Password</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

</div>
<script src="../js/user_valid.js"></script>  <!--user_valid.js eka link krnwa meka </body> ekata kalin hari </head> ekata anthimata hari krnna ona -->



<style>
    .container {
        position: relative;
    }

    .card {
        width: 40%; /* Adjust the width to your desired size (in percentage or pixels) */
        position: absolute;
        right: 0;
        bottom: 0;
        margin: 285px; /* Adjust the margin as needed */
    }
    
    /* Change button size */
    #submit {
        width: 250px; /* Adjust the width to your desired size in pixels or percentage */
        height: 40px; /* Adjust the height to your desired size in pixels or percentage */
    }

    /* Change textbox size */
    input[type="password"] {
        width: 100%; /* Adjust the width to your desired size in pixels or percentage */
        height: 30px; /* Adjust the height to your desired size in pixels or percentage */
    }


</style>


<?php
include_once("../view/footer.php");
?>