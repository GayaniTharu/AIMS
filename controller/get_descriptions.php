<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "aims";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['news_id'])) {
    $news_id = $_POST['news_id'];

    // Query the database to get descriptions for the specified news item
    $sql = "SELECT descriptions FROM add_news WHERE id = $news_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $descriptions = $row['descriptions'];
        echo $descriptions;
    } else {
        echo "No descriptions found for this news item.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>



