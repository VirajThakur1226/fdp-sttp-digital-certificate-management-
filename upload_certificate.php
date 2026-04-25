<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $event_name = $_POST['event_name'];
    $organizer = $_POST['organizer'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $academic_year = $_POST['academic_year'];
    $program_type  = $_POST['program_type'];

    // Calculate duration
    $start = strtotime($start_date);
    $end = strtotime($end_date);
    $duration = ($end - $start) / (60 * 60 * 24) + 1;

    if ($duration < 5) {
        echo "<script>alert('FDP/STTP must be minimum 5 days');</script>";
    } else {

        $file_name = $_FILES['certificate']['name'];
        $temp_name = $_FILES['certificate']['tmp_name'];
        $folder = "uploads/" . $file_name;

        move_uploaded_file($temp_name, $folder);

        $sql = "INSERT INTO certificates
        (user_id, academic_year, program_type, event_name, organizer, start_date, end_date, duration, file_name, status)
        VALUES
        ('$user_id','$academic_year','$program_type','$event_name','$organizer','$start_date','$end_date','$duration','$file_name','Pending')";

        mysqli_query($conn, $sql);

        echo "<script>alert('Certificate Uploaded Successfully!'); window.location='user_dashboard.php';</script>";
    }
}
if(isset($_POST['submit'])) {

    $target_dir = "uploads/";

    // Create unique file name
    $file_name = time() . "_" . basename($_FILES["certificate"]["name"]);

    $target_file = $target_dir . $file_name;

    // Allowed file types
    $allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];

    if(in_array($_FILES["certificate"]["type"], $allowed_types)) {

        if(move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

            // Save only file name in database
            $sql = "INSERT INTO certificates 
            (user_id, academic_year, program_type, event_name, organizer, start_date, end_date, duration, file_name, status)
            VALUES 
            ('$user_id','$academic_year','$program_type','$event_name','$organizer','$start_date','$end_date','$duration','$file_name','Pending')";

            mysqli_query($conn, $sql);

            echo "Certificate uploaded successfully!";

        } else {
            echo "Error uploading file.";
        }

    } else {
        echo "Only PDF, JPG, PNG files are allowed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Certificate</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

/* Main Form Box */
.form-container {
    width: 450px;
    margin: 60px auto;
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

/* Heading */
h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Labels */
label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
}

/* Inputs */
input[type="text"],
input[type="date"],
select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
}

/* Radio buttons */
.radio-group {
    margin-top: 5px;
}

.radio-group input {
    width: auto;
}

/* File input */
input[type="file"] {
    margin-top: 5px;
}

/* Button */
button {
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    background-color: #1f4db8;
    color: white;
    border: none;
    border-radius: 4px;
}

button:hover {
    background-color: #163d91;
}

/* Back link */
.back-link {
    display: block;
    text-align: center;
    margin-top: 15px;
}
.navbar {
        flex-direction: column;
        align-items: flex-start;
        display:flex;
        justify-content:space-between;
        align-items:center;
        background-color:#1047a5;
        padding:15px 30px;
    }
    .navbar a{
    color: white;          
    text-decoration: none; 
    padding: 8px 15px;    
    font-size: 16px;
}
.navbar a:hover{
    background-color: #0e0ebb;
    border-radius: 5px;
}
.navbar a:active{
    color: yellow;
}
</style>
</head>
<body>
<div class="navbar">
    <div><h2>FDP Certificate System</h2></div>
    <div>
        <a href="user_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
<div class="form-container">

<h2>Upload FDP/STTP Certificate</h2>

<form name="uploadForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

<label>Event Name:</label>
<input type="text" name="event_name" required>

<label>Organizer:</label>
<input type="text" name="organizer" required>

<label>Academic Year:</label>
<select name="academic_year" required>
    <option value="">Select AY</option>
    <option>2023-24</option>
    <option>2024-25</option>
    <option>2025-26</option>
</select>

<label>Program Type:</label>
<div class="radio-group">
    <input type="radio" name="program_type" value="FDP"> FDP
    <input type="radio" name="program_type" value="STTP"> STTP
</div>

<label>Start Date:</label>
<input type="date" id="start_date" name="start_date" onchange="calculateDuration()">

<label>End Date:</label>
<input type="date" id="end_date" name="end_date" onchange="calculateDuration()">

<label>Upload Certificate:</label>
<input type="file" name="certificate" required>

<button type="submit" name="submit">Submit</button>
</form>
<a href="user_dashboard.php" class="back-link">Back to Dashboard</a>
</div>
<script>
function validateForm() {

    var eventName = document.forms["uploadForm"]["event_name"].value;
    var organizer = document.forms["uploadForm"]["organizer"].value;
    var startDate = document.forms["uploadForm"]["start_date"].value;
    var endDate = document.forms["uploadForm"]["end_date"].value;

    if (eventName == "" || organizer == "") {
        alert("All fields must be filled out");
        return false;
    }

    if (startDate > endDate) {
        alert("End Date must be after Start Date");
        return false;
    }

    return true;
}
function calculateDuration() {
    let start = new Date(document.getElementById("start_date").value);
    let end = new Date(document.getElementById("end_date").value);

    if (start && end && end >= start) {
        let diff = (end - start) / (1000 * 60 * 60 * 24) + 1;
        document.getElementById("duration").value = diff;
    }
}
</script>
</body>
</html>