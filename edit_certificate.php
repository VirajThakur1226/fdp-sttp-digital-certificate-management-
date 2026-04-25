<?php
session_start();
include("db.php");

$id = $_GET['id'];

// Fetch data
$data = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT * FROM certificates WHERE id='$id'"));

// Allow only rejected
if($data['status'] != "Rejected"){
    echo "Editing not allowed";
    exit();
}

// Update
if(isset($_POST['update'])){
    $event_name = $_POST['event_name'];
    $organizer = $_POST['organizer'];
    $academic_year = $_POST['academic_year'];
    $program_type = $_POST['program_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Duration calculation
    $duration = (strtotime($end_date) - strtotime($start_date)) / (60*60*24);

    mysqli_query($conn, "UPDATE certificates SET 
        event_name='$event_name',
        organizer='$organizer',
        academic_year='$academic_year',
        program_type='$program_type',
        start_date='$start_date',
        end_date='$end_date',
        duration='$duration',
        status='Pending',
        rejection_reason=NULL
        WHERE id='$id'");

    header("Location: user_dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Certificate</title>
<style>

body{
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 0;
}

/* Form Container */
.form-box{
    width: 400px;
    margin: 60px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Heading */
.form-box h2{
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Labels */
.form-box label{
    display: block;
    margin-top: 10px;
    font-weight: bold;
    font-size: 14px;
}

/* Inputs */
.form-box input,
.form-box select,
.form-box textarea{
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

/* Radio buttons */
.form-box input[type="radio"]{
    width: auto;
    margin-right: 5px;
}

/* Button */
.form-box button{
    width: 100%;
    margin-top: 15px;
    padding: 10px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

/* Button hover */
.form-box button:hover{
    background: #2980b9;
}

/* Reject button special */
.reject-btn{
    background: #e74c3c;
}
.reject-btn:hover{
    background: #c0392b;
}

/* Back link */
.back-link{
    display: block;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
    color: #555;
}

.back-link:hover{
    text-decoration: underline;
}

</style>
</head>
<body>
<div class="form-box">
<h2>Edit Certificate</h2>

<form method="POST">

<label>Event Name</label>
<input type="text" name="event_name" value="<?= $data['event_name'] ?>">

<label>Organizer</label>
<input type="text" name="organizer" value="<?= $data['organizer'] ?>">

<label>Academic Year</label>
<select name="academic_year">
    <option <?= $data['academic_year']=="2023-24"?"selected":"" ?>>2023-24</option>
    <option <?= $data['academic_year']=="2024-25"?"selected":"" ?>>2024-25</option>
</select>

<label>Program Type</label>
<input type="radio" name="program_type" value="FDP" <?= $data['program_type']=="FDP"?"checked":"" ?>> FDP
<input type="radio" name="program_type" value="STTP" <?= $data['program_type']=="STTP"?"checked":"" ?>> STTP

<label>Start Date</label>
<input type="date" name="start_date" value="<?= $data['start_date'] ?>">

<label>End Date</label>
<input type="date" name="end_date" value="<?= $data['end_date'] ?>">

<button name="update">Update Certificate</button>

</form>

<a href="user_dashboard.php" class="back-link">Back</a>
</div>
</form>

</body>
</html>