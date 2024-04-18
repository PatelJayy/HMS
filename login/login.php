    <?php
    $login = false;
    $error = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'partials/_dbconnect.php';
        
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);  // Consider hashing passwords in production
        
        // SQL injection prevention
        $sql = "SELECT * FROM users WHERE username=? AND password=?";  // Update this to handle hashed passwords

        // Prepare statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['role'];

                switch ($row['role']) {
                    case 'admin':
                        header("location: admin/admin_welcome.php");
                        exit;
                    case 'doctor':
                        header("location: doctor/doctor_welcome.php"); // Adjust this path as needed
                        exit;
                    default:
                        header("location: patient/patient_welcome.php"); // Adjust this path as needed
                        exit;
                }
            } else {
                $error = true;
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
    ?>  

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body>
    <?php require 'partials/_nav.php' ?>

    <?php if ($login): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> You are now logged in
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong> Invalid credentials
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="container">
        <h1 class='text-center'>Login to the website</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
    </html>
