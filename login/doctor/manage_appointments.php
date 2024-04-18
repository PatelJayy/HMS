<?php
// Connection to the database
require '../partials/_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $appointment_id = $_POST['appointment_id'];
    $new_status = $_POST['status'];

    // Update query
    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    
    // Prepare statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $new_status, $appointment_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Fetch all appointments
$result = mysqli_query($conn, "SELECT * FROM appointments");

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Manage Appointments</title>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Manage Appointments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                <td><?= htmlspecialchars($row['appointment_time']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="appointment_id" value="<?= $row['id'] ?>">
                        <select name="status" class="form-control">
                            <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Approved" <?= $row['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                        </select>
                        <button type="submit" name="update_status" class="btn btn-info mt-2">Update</button>
                    </form>
                    
                </td>
            </tr>

            <?php endwhile; ?>
        </tbody>
       
    </table>
    <a href="doctor_welcome.php" class="btn btn-secondary">Go Back</a>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
                