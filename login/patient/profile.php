<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

 require '../partials/_dbconnect.php';

      // Ensure you have a db.php file that handles database connection

// Define variables for user feedback
$username_err = $photo_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is being updated
    if (!empty(trim($_POST["username"]))) {
        $new_username = trim($_POST["username"]);
        // Prepare a select statement to check if the username exists
        $sql = "UPDATE users SET username = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $param_username, $_SESSION['id']);

            $param_username = $new_username;

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['username'] = $new_username;  // Update session variable
                echo "Username updated successfully.";
            } else {
                $username_err = "This username is already taken.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Check if a new profile photo is being uploaded
    if (!empty($_FILES["profile_photo"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $photo_err = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $photo_err = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_photo"]["size"] > 500000) {
            $photo_err = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
            $photo_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $photo_err = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
                // Here, you might want to also update the path of the photo in your database
                echo "The file ". htmlspecialchars( basename( $_FILES["profile_photo"]["name"])). " has been uploaded.";
            } else {
                $photo_err = "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <p>Please fill out this form to update your profile.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div>
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>">
                <span><?php echo $username_err; ?></span>
            </div>
            <div>
                <label>Profile Photo</label>
                <input type="file" name="profile_photo">
                <span><?php echo $photo_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Update Profile">
            </div>
        </form>
    </div>
</body>
</html>
