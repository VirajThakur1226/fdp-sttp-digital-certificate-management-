<?php
session_start();
include("db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, 
    "UPDATE certificates SET status='$status' WHERE id='$id'"
);

header("Location: manage_certificates.php");
exit();
?>