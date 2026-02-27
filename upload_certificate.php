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
                (user_id, event_name, organizer, start_date, end_date, duration, file_name, status)
                VALUES 
                ('$user_id','$event_name','$organizer','$start_date','$end_date','$duration','$file_name','Pending')";

        mysqli_query($conn, $sql);

        echo "<script>alert('Certificate Uploaded Successfully!'); window.location='user_dashboard.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Certificate</title>
</head>
<body>

<h2>Upload FDP/STTP Certificate</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Event Name:</label><br>
    <input type="text" name="event_name" required><br><br>

    <label>Organizer:</label><br>
    <input type="text" name="organizer" required><br><br>

    <label>Academic Year:</label><br>
    <select name="academic_year" required>
    <option value="">Select AY</option>
    <option value="2023-24">2023-24</option>
    <option value="2024-25">2024-25</option>
    <option value="2025-26">2025-26</option>
    </select><br><br>

    <label>Program Type:</label><br>
    <input type="radio" name="program_type" value="FDP" required> FDP
    <input type="radio" name="program_type" value="STTP" required> STTP
    <br><br>

    <label>Start Date:</label><br>
    <input type="date" name="start_date" required><br><br>

    <label>End Date:</label><br>
    <input type="date" name="end_date" required><br><br>

    <label>Upload Certificate (PDF/JPG/PNG):</label><br>
    <input type="file" name="certificate" required><br><br>

    <button type="submit" name="submit">Submit</button>
</form>

<br>
<a href="user_dashboard.php">Back to Dashboard</a>

</body>
</html>