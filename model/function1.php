<?php

require_once '../common/db.php';




// In function.php
function delete_farmer($id) {
    global $con; // Make sure you have the database connection available
    
    $query = "DELETE FROM far_reg WHERE far_id = $id";
    mysqli_query($con, $query);
}
