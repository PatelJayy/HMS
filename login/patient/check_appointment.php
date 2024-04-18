<?php
// Connection to the database
require '../partials/_dbconnect.php';

$statusMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check_status'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);

    // Fetch the status of the appointment
    $sql = "SELECT status FROM appointments WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $appointment_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $statusMessage = "The status of your appointment is: " . htmlspecialchars($row['status']);
        } else {
            $statusMessage = "No appointment found with that ID.";

        }
        mysqli_stmt_close($stmt);
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
    <title>Check Appointment Status</title>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Check Your Appointment Status</h2>
    <form method="post">
        <div class="form-group">
            <label for="appointment_id">Appointment ID:</label>
            <input type="number" class="form-control" id="appointment_id" name="appointment_id" required>
        </div>
        <button type="submit" name="check_status" class="btn btn-primary">Check Status</button>
        <a href="patient_appointment.php" class="btn btn-primary">Book appointment</a>
        
    </form>
    <?php if ($statusMessage): ?>
        <div class="alert alert-info mt-4"><?php echo $statusMessage; ?></div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
