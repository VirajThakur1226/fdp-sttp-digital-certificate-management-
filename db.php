<?php
$conn = mysqli_connect("localhost", "root", "", "fdp_certificate");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>