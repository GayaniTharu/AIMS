
<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "aims";

try {
    $connect = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
