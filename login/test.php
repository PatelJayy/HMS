<?php

session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome -<?php echo $_SESSION['username'] ?></title>

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      overflow-x: hidden;
    }

    .sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: -250px;
      background-color: #333;
      padding-top: 50px;
      transition: all 0.3s ease;
    }

    .sidebar.show {
      left: 0;
    }

    .sidebar ul.components {
      padding: 20px 0;
      border-bottom: 1px solid #4e4e4e;
    }

    .sidebar ul.components li {
      padding: 10px 15px;
      border-bottom: 1px solid #4e4e4e;
      color: #fff;
    }

    .sidebar ul.components li a {
      color: #fff;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
    }

    .navbar-brand {
      cursor: pointer;
    }
  </style>
</head>
<body>

<?php require 'partials/_nav.php' ?>

<div class="wrapper">
  <!-- Sidebar -->
  <nav id="sidebar" class="sidebar">
    <ul class="list-unstyled components">
      <li>
        <a href="#">Home</a>
      </li>
      <li>
        <a href="#">About</a>
      </li>
      <li>
        <a href="#">Services</a>
      </li>
      <li>
        <a href="#">Contact</a>
      </li>
    </ul>
  </nav>

  <!-- Page Content -->
  <div id="content" class="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
    <!-- Page content goes here -->
    <h2>Content Here</h2>
  </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JavaScript -->
<script>
  $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('show');
    });
  });
</script>
</body>
</html>
