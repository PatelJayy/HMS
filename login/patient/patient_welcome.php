<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        /* Sidebar styles */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 25px;
            color: #808080;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            color: #f1f1f1;
        }
        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        @media screen and (max-height: 450px) {
          .sidebar {padding-top: 15px;}
          .sidebar a {font-size: 18px;}
        }
    </style>
    <title>Welcome - <?php echo $_SESSION['username'] ?></title>
</head>
<body>
    <?php require '../partials/_nav.php' ?>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="profile.php">Profile</a>
        <a href="settings.php">Settings</a>
        <a href="bedbook.php">Patients</a>
        <a href="patient_appointment.php">Appointments</a>
        <a href="check_appointment.php">Check appointments</a>
    </div>

    <div id="main">
        <button class="btn btn-primary" onclick="openNav()">☰</button>
        <div class="container">
            <!-- Content Here -->
            Welcome - <?php echo $_SESSION['username'] ?>
            <!-- Your existing content goes here -->
        </div>
    </div>

    <div class="container mt-5">
        <h1>Welcome to Our Hospital Management System (HMS)</h1>
        <p>Our Hospital Management System is an innovative solution designed to streamline operations and improve the quality of care in healthcare settings. With HMS, healthcare providers can efficiently manage patient information, appointments, medical records, and billing processes all in one integrated platform.</p>

        <h2>Key Features:</h2>
        <ul>
            <li><strong>Patient Management:</strong> Securely store and manage all patient data including medical history, treatment plans, and personal information.</li>
            <li><strong>Appointment Scheduling:</strong> Allow patients and staff to view available timeslots and book appointments seamlessly, reducing wait times and improving service delivery.</li>
            <li><strong>Electronic Health Records (EHR):</strong> Access and update patient records in real-time, ensuring that information is accurate and up-to-date for every consultation.</li>
            <li><strong>Billing and Invoicing:</strong> Automated billing systems that handle insurance processing and payments, making financial transactions smooth and transparent.</li>
            <li><strong>Reporting and Analytics:</strong> Generate detailed reports on hospital operations, patient care activities, and financial management to help make informed decisions.</li>
        </ul>

        <h2>Our Commitment:</h2>
        <p>At the core of our HMS is a commitment to patient-centered care. We are dedicated to providing a system that supports not only healthcare providers but also enhances the patient's experience, ensuring privacy, security, and easy access to health care services.</p>

        <h2>For Healthcare Professionals:</h2>
        <p>HMS offers tools that help reduce the administrative burden, allowing medical staff to focus more on patient care rather than paperwork. With integrated communication tools, coordination between different departments is streamlined, making the healthcare delivery process more effective.</p>

        <h2>For Patients:</h2>
        <p>Our intuitive platform allows patients easy access to their personal health information, appointment scheduling, and direct communication with healthcare providers, empowering them to take an active role in their healthcare management.</p>

        <h2>Join Us:</h2>
        <p>Experience the efficiency of our Hospital Management System and transform the way your healthcare facility operates. Embrace the future of healthcare today.</p>
    </div>


    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
        }
    </script>

    <!-- Bootstrap and jQuery scripts as before -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
