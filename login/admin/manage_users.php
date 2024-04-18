<?php
session_start();
include('../partials/_dbconnect.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_role'])) {
    $userId = $_POST['user_id'];
    $newRole = $_POST['role'];
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE sno = ?");
    $stmt->bind_param("si", $newRole, $userId);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Role updated successfully!');</script>";
}

$result = $conn->query("SELECT sno, username, role FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-4">
        <h2>Manage Users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<form method='POST'>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>";
                    echo "<select name='role' class='form-control'>";
                    echo "<option value='admin'" . ($row['role'] == 'admin' ? ' selected' : '') . ">Admin</option>";
                    echo "<option value='doctor'" . ($row['role'] == 'doctor' ? ' selected' : '') . ">Doctor</option>";
                    echo "<option value='user'" . ($row['role'] == 'user' ? ' selected' : '') . ">User</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td>";
                    echo "<input type='hidden' name='user_id' value='" . $row['sno'] . "'>";
                    echo "<button type='submit' name='update_role' class='btn btn-primary'>Update Role</button>";
                    echo "</td>";
                    echo "</form>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="admin_welcome.php" class="btn btn-secondary">Go Back</a>
    
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
