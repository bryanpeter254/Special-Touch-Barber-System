<?php
$conn = new mysqli("localhost", "root", "", "barbershop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
