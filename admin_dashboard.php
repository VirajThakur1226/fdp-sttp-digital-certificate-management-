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

<style>
body{
    font-family: Arial, sans-serif;
    background-color:#f4f6f9;
    margin:0;
    padding:0;
}

.container{
    width:80%;
    margin:auto;
    margin-top:40px;
}

h2{
    text-align:center;
    color:#333;
}

.dashboard-box{
    display:flex;
    justify-content:space-around;
    margin-top:30px;
}

.card{
    background:white;
    padding:20px;
    width:200px;
    text-align:center;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.card h3{
    margin-bottom:10px;
}

.card p{
    font-size:20px;
    font-weight:bold;
}

.links{
    text-align:center;
    margin-top:40px;
}

a{
    text-decoration:none;
    padding:10px 20px;
    background:#007bff;
    color:white;
    border-radius:5px;
    margin:5px;
}

a:hover{
    background:#0056b3;
}
</style>

</head>
<body>

<div class="container">

<h2>Admin Dashboard</h2>
<p style="text-align:center;">Welcome, Admin</p>

<div class="dashboard-box">

<div class="card">
<h3>Total Users</h3>
<p><?php echo $user_count; ?></p>
</div>

<div class="card">
<h3>Total Certificates</h3>
<p><?php echo $cert_count; ?></p>
</div>

<div class="card">
<h3>Pending Approvals</h3>
<p><?php echo $pending_count; ?></p>
</div>

</div>

<div class="links">
<a href="manage_certificates.php">Manage Certificates</a>
<a href="logout.php">Logout</a>
</div>

</div>

</body>
</html>