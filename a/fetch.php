<?php
header('Content-Type: application/json'); // Set the JSON content type

include('database_connection.php');

$column = array("farmer_id", "full_name", "nic", "total_area", "grow_area", "urea1", "urea2", "urea3", "tsp", "mop", "zs");

$query = "SELECT * FROM user2 ";

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY farmer_id DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}




$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$result = $connect->query($query . $query1);

$data = array();

foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row['farmer_id'];
    $sub_array[] = '<a href="#" class="editable" data-name="full_name" data-pk="' . $row['farmer_id'] . '">' . $row['full_name'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="nic" data-pk="' . $row['farmer_id'] . '">' . $row['nic'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="total_area" data-pk="' . $row['farmer_id'] . '">' . $row['total_area'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="grow_area" data-pk="' . $row['farmer_id'] . '">' . $row['grow_area'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="urea1" data-pk="' . $row['farmer_id'] . '">' . $row['urea1'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="urea2" data-pk="' . $row['farmer_id'] . '">' . $row['urea2'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="urea3" data-pk="' . $row['farmer_id'] . '">' . $row['urea3'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="tsp" data-pk="' . $row['farmer_id'] . '">' . $row['tsp'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="mop" data-pk="' . $row['farmer_id'] . '">' . $row['mop'] . '</a>';
    $sub_array[] = '<a href="#" class="editable" data-name="zs" data-pk="' . $row['farmer_id'] . '">' . $row['zs'] . '</a>';
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT * FROM user2";

    $statement = $connect->prepare($query);

    $statement->execute();

    return $statement->rowCount();
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => count_all_data($connect),
    'recordsFiltered' => $number_filter_row,
    'data' => $data
);

echo json_encode($output);
?>
