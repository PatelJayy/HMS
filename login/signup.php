<?php
$showAlert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    
    $username = $_POST["username"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $existSql="SELECT * FROM `users` WHERE username='$username'";
    // Ensure password and confirm password match
    if ($password == $cpassword) {
        $sql = "INSERT INTO `users` (`username`, `Gender`, `password`, `dt`) VALUES ('$username', '$gender', '$password', current_timestamp());";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Passwords don't match, handle error or alert user
        echo '<div class="alert alert-danger" role="alert">Passwords do not match!</div>';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">

    <title>Signup</title>
</head>
<body>
<?php require 'partials/_nav.php' ?>

<?php if ($showAlert): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> Your account is created. You can now login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="container">
    <h1 class='text-center'>Signup to the website</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>

        <div class="form-group">
            <label>Gender:</label>
            <br>
            <label>Male:</label>
            <input type="radio" class="form-control" name="gender" value="male" required>
            <label for="female">Female</label>
            <input type="radio" class="form-control" name="gender" value="female" required>
            <label for="other">Other</label>
            <input type="radio" class="form-control" name="gender" value="other" required>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
            <small id="emailHelp" class="form-text text-muted">Passwords should match</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
