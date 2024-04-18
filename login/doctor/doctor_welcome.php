<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['role'] != 'doctor') {
    header("location: login.php");
    exit;
}

// Include necessary files
// Original line that's causing the error:
// include 'partials/_dbconnect.php';

// Updated line with correct path:
include '../partials/_dbconnect.php';
// Ensure this file contains database connection setup
require '../partials/_nav.php'; // Navigation bar
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <title>Doctor Dashboard</title>
</head>
<body>
<div class="container mt-4">
    <h1>Welcome, <?php echo $_SESSION['username']; ?> - Doctor Panel</h1>
    <div class="list-group">
        <a href="reports.php" class="list-group-item list-group-item-action">View Reports</a>
        <a href="manage_appointments.php" class="list-group-item list-group-item-action">Manage Appointments</a>
        <a href="feedback.php" class="list-group-item list-group-item-action">View Feedback</a>
    </div>
</div>

<!-- Bootstrap and jQuery scripts as before -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
