<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM certificates WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if ($data['status'] == "Approved") {
    echo "<script>alert('Approved certificate cannot be edited'); 
          window.location='user_dashboard.php';</script>";
    exit();
}

if (isset($_POST['update'])) {

    $event_name = $_POST['event_name'];
    $organizer = $_POST['organizer'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $start = strtotime($start_date);
    $end = strtotime($end_date);
    $duration = ($end - $start) / (60 * 60 * 24) + 1;

    if ($duration < 5) {
        echo "<script>alert('Minimum 5 days required');</script>";
    } else {

        // If new file uploaded
        if ($_FILES['certificate']['name'] != "") {
            $file_name = $_FILES['certificate']['name'];
            $temp_name = $_FILES['certificate']['tmp_name'];
            move_uploaded_file($temp_name, "uploads/".$file_name);

            mysqli_query($conn, "UPDATE certificates SET 
                event_name='$event_name',
                organizer='$organizer',
                start_date='$start_date',
                end_date='$end_date',
                duration='$duration',
                file_name='$file_name'
                WHERE id='$id'");
        } else {

            mysqli_query($conn, "UPDATE certificates SET 
                event_name='$event_name',
                organizer='$organizer',
                start_date='$start_date',
                end_date='$end_date',
                duration='$duration'
                WHERE id='$id'");
        }

        echo "<script>alert('Certificate Updated Successfully'); 
              window.location='user_dashboard.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Certificate</title>
</head>
<body>

<h2>Edit Certificate</h2>

<form method="POST" enctype="multipart/form-data">

    Event Name:<br>
    <input type="text" name="event_name" 
           value="<?php echo $data['event_name']; ?>" required><br><br>

    Organizer:<br>
    <input type="text" name="organizer" 
           value="<?php echo $data['organizer']; ?>" required><br><br>

    Start Date:<br>
    <input type="date" name="start_date" 
           value="<?php echo $data['start_date']; ?>" required><br><br>

    End Date:<br>
    <input type="date" name="end_date" 
           value="<?php echo $data['end_date']; ?>" required><br><br>

    Replace Certificate (Optional):<br>
    <input type="file" name="certificate"><br><br>

    <button type="submit" name="update">Update</button>

</form>

<br>
<a href="user_dashboard.php">Back to Dashboard</a>

</body>
</html>