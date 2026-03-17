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

<style>

body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:20px;
}

h2{
    text-align:center;
    color:#333;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

th{
    background:#007bff;
    color:white;
    padding:10px;
}

td{
    padding:10px;
    text-align:center;
}

tr:nth-child(even){
    background:#f2f2f2;
}

a{
    text-decoration:none;
    padding:5px 10px;
    border-radius:4px;
}

.approve{
    background:green;
    color:white;
}

.reject{
    background:red;
    color:white;
}

.view{
    background:#17a2b8;
    color:white;
}

.back{
    display:inline-block;
    margin-top:20px;
    padding:10px 15px;
    background:#333;
    color:white;
    border-radius:5px;
}

</style>

</head>
<body>

<h2>Manage Certificates</h2>

<table border="1">
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
<a class="view" href="uploads/<?php echo $row['file_name']; ?>" target="_blank">
View File
</a>
</td>

<td>
<?php if($row['status'] == "Pending") { ?>

<a class="approve"
href="update_status.php?id=<?= $row['id'] ?>&status=Approved"
onclick="return confirm('Are you sure you want to approve this certificate?')">
Approve
</a>

|

<a class="reject"
href="update_status.php?id=<?= $row['id'] ?>&status=Rejected"
onclick="return confirm('Are you sure you want to reject this certificate?')">
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
<a class="back" href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>