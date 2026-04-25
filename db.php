<?php
$conn = mysqli_connect("localhost", "root", "", "fdp_certificate2");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>