<?php
// Connection to the database
require '../partials/_dbconnect.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $patient_phone = mysqli_real_escape_string($conn, $_POST['patient_phone']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
    $bed_type = mysqli_real_escape_string($conn, $_POST['bed_type']);

    // Insert query
    $sql = "INSERT INTO appointments (patient_id, patient_name, patient_phone, appointment_date, appointment_time, bed_type, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
    
    // Prepare statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "isssss", $patient_id, $patient_name, $patient_phone, $appointment_date, $appointment_time, $bed_type);
        mysqli_stmt_execute($stmt);
        $message = "Appointment booked successfully!";
        mysqli_stmt_close($stmt);
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Book an Appointment</title>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Book Your Bed</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST" action="patient_appointment.php">
        <div class="form-group">
            <label for="patient_id">Patient ID:</label>
            <input type="text" class="form-control" id="patient_id" name="patient_id" required>
        </div>
        <div class="form-group">
            <label for="patient_name">Patient Name:</label>
            <input type="text" class="form-control" id="patient_name" name="patient_name" required>
        </div>
        <div class="form-group">
            <label for="patient_phone">Phone Number:</label>
            <input type="text" class="form-control" id="patient_phone" name="patient_phone" required>
        </div>
        <div class="form-group">
            <label for="appointment_date">Date:</label>
            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
        </div>
        <div class="form-group">
            <label for="appointment_time">Time:</label>
            <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
        </div>
        <div class="form-group">
            <label for="bed_type">Bed Type:</label>
            <select class="form-control" id="bed_type" name="bed_type">
                <option value="General">General</option>
                <option value="Semi-Private">Semi-Private</option>
                <option value="Private">Private</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="check_appointment.php" class="btn btn-primary">check appointment</a>

    </form>
   <br>
    <a href="patient_welcome.php"class="btn btn-secondary">Go back</a>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
