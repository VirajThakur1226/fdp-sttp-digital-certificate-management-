<?php
session_start();
include("db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Count total users
$user_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));

// Count total certificates
$cert_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM certificates"));

// Count pending certificates
$pending_count = mysqli_num_rows(mysqli_query($conn, 
                "SELECT * FROM certificates WHERE status='Pending'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Admin Dashboard</h2>
<p>Welcome, Admin</p>

<hr>

<h3>System Overview</h3>

<p>Total Users: <?php echo $user_count; ?></p>
<p>Total Certificates: <?php echo $cert_count; ?></p>
<p>Pending Approvals: <?php echo $pending_count; ?></p>

<br>

<a href="manage_certificates.php">Manage Certificates</a>
<br><br>
<a href="logout.php">Logout</a>

</body>
</html>