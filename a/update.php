<?php
include('database_connection.php');

if(isset($_POST["name"]) && isset($_POST["value"]) && isset($_POST["pk"])) {
    $query = "UPDATE user2 SET ".$_POST["name"]." = :value WHERE farmer_id = :pk";

    $statement = $connect->prepare($query);

    $statement->execute(
        array(
            ':value' => $_POST["value"],
            ':pk'    => $_POST["pk"]
        )
    );
}


?>
