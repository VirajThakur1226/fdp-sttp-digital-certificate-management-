<?php
session_start();
include("db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$query = mysqli_query($conn, "
    SELECT certificates.*, users.name 
    FROM certificates 
    JOIN users ON certificates.user_id = users.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Certificates</title>
</head>
<body>

<h2>Manage Certificates</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>User Name</th>
        <th>Event Name</th>
        <th>Organizer</th>
        <th>Academic Year</th>
        <th>Program Type</th>
        <th>Duration</th>
        <th>Status</th>
        <th>View</th>
        <th>Action</th>
    </tr>

<?php while($row = mysqli_fetch_assoc($query)) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['event_name']; ?></td>
    <td><?php echo $row['organizer']; ?></td>
    <td><?php echo $row['academic_year']; ?></td>
    <td><?php echo $row['program_type']; ?></td>
    <td><?php echo $row['duration']; ?> Days</td>
    <td><?php echo $row['status']; ?></td>

    <td>
        <a href="uploads/<?php echo $row['file_name']; ?>" target="_blank">
            View File
        </a>
    </td>

    <td>
        <?php if($row['status'] == "Pending") { ?>
            <a href="update_status.php?id=<?php echo $row['id']; ?>&status=Approved">
                Approve
            </a>
            |
            <a href="update_status.php?id=<?php echo $row['id']; ?>&status=Rejected">
                Reject
            </a>
        <?php } else {
            echo "No Action";
        } ?>
    </td>
</tr>

<?php } ?>

</table>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>