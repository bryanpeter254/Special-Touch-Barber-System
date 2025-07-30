<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "barbershop";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query: Total clients this month
$current_month = date('m');
$current_year = date('Y');

$sql = "SELECT COUNT(*) AS total_clients 
        FROM client_checkins 
        WHERE MONTH(date_of_visit) = ? AND YEAR(date_of_visit) = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $current_month, $current_year);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
echo $row['total_clients'];

$stmt->close();
$conn->close();
?>
