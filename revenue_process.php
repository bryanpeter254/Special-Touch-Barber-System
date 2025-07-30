<?php
require_once 'inc/db.php';  // Correct path to DB connection
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = trim($_POST['date']);
    $client_name = trim($_POST['client_name']);
    $service = trim($_POST['service']);
    $price = trim($_POST['price']);
    $offered_by = trim($_POST['offered_by']);

    // Validate required fields
    if (empty($date) || empty($client_name) || empty($service) || empty($price) || empty($offered_by)) {
        header("Location: revenue.php?error=Missing+fields");
        exit();
    }

    // Prepare SQL
    $stmt = $conn->prepare("INSERT INTO revenue (date, client_name, service, price, offered_by) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        header("Location: revenue.php?error=Prepare+failed:" . urlencode($conn->error));
        exit();
    }

    // Bind parameters: s = string, d = double
    $stmt->bind_param("sssds", $date, $client_name, $service, $price, $offered_by);

    // Execute and redirect
    if ($stmt->execute()) {
        header("Location: revenue.php?success=1");
    } else {
        header("Location: revenue.php?error=" . urlencode($stmt->error));
    }

    $stmt->close();
} else {
    header("Location: revenue.php?error=Invalid+request");
}

$conn->close();
?>
