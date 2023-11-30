<?php
include('database_connection.php');

$query = "UPDATE tbl_sample SET ".$_POST["name"]." = :value WHERE id = :pk";

$statement = $connect->prepare($query);

$statement->execute(
    array(
        ':value' => $_POST["value"],
        ':pk'    => $_POST["pk"]
    )
);
?>
