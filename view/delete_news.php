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
    
    // Delete the news item from the database
    $delete_sql = "DELETE FROM add_news WHERE id = $news_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "News deleted successfully.";
    } else {
        echo "Error deleting news: " . $conn->error;
    }
}
?>
