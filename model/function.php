<?php

require_once '../common/db.php';

function display_data(){
    global $con;
    $query = "SELECT * FROM far_reg"; // Corrected table name
    $result = mysqli_query($con, $query);
    return $result;
}


