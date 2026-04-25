<?php
session_start();
include("db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Get filter value
$filter_department = isset($_GET['department']) ? $_GET['department'] : '';

// Build query based on filter
$sql = "
    SELECT certificates.*, users.name, users.contact_no, users.department
    FROM certificates 
    JOIN users ON certificates.user_id = users.id
    WHERE 1=1
";

if($filter_department != ""){
    $sql .= " AND users.department = '$filter_department'";
}

$sql .= " ORDER BY users.department";

$query = mysqli_query($conn, $sql);
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

/* Filter Form */
.filter-form{
    display:flex;
    justify-content:center;
    gap:15px;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.filter-form select{
    padding:8px 12px;
    border:1px solid #ccc;
    border-radius:5px;
    font-size:14px;
}

.filter-form button{
    padding:8px 18px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:14px;
}

.filter-form button:hover{
    background:#0056b3;
}

.clear-btn{
    padding:8px 18px;
    background:#6c757d;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:14px;
    text-decoration:none;
}

.clear-btn:hover{
    background:#545b62;
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

.btn{
    display:inline-block;
    padding:6px 10px;
    margin:2px;
    font-size:13px;
    border-radius:6px;
    color:white;
    transition:0.2s;
}

.view-btn{
    background:#17a2b8;
}

.view-btn:hover{
    background:#138496;
}

.download-btn{
    background:#28a745;
}

.download-btn:hover{
    background:#218838;
}

.approve{
    background:#28a745;
    color:white;
    padding:5px 10px;
    border-radius:4px;
}

.approve:hover{
    background:#218838;
}

.reject-btn{
    background:#dc3545;
}

.reject-btn:hover{
    background:#c82333;
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

<!-- Filter Form -->
<form class="filter-form" method="GET">

    <select name="department">
        <option value="">-- All Departments --</option>
        <option value="Computer Engineering" <?= $filter_department=="Computer Engineering"?"selected":"" ?>>Computer Engineering</option>
        <option value="Information Technology" <?= $filter_department=="Information Technology"?"selected":"" ?>>Information Technology</option>
        <option value="Electronics & Telecommunication" <?= $filter_department=="Electronics & Telecommunication"?"selected":"" ?>>Electronics & Telecommunication</option>
        <option value="Mechanical Engineering" <?= $filter_department=="Mechanical Engineering"?"selected":"" ?>>Mechanical Engineering</option>
        <option value="Civil Engineering" <?= $filter_department=="Civil Engineering"?"selected":"" ?>>Civil Engineering</option>
        <option value="Electrical Engineering" <?= $filter_department=="Electrical Engineering"?"selected":"" ?>>Electrical Engineering</option>
    </select>

    <button type="submit">Filter</button>
    <a href="manage_certificates.php" class="clear-btn">Clear</a>

</form>

<table border="1">
<tr>
<th>ID</th>
<th>User Name</th>
<th>Department</th>
<th>Contact No</th>
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
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['contact_no']; ?></td>
<td><?php echo $row['event_name']; ?></td>
<td><?php echo $row['organizer']; ?></td>
<td><?php echo $row['academic_year']; ?></td>
<td><?php echo $row['program_type']; ?></td>
<td><?php echo $row['duration']; ?> Days</td>
<td><?php echo $row['status']; ?></td>

<td>
    <a href="uploads/<?php echo $row['file_name']; ?>" target="_blank" class="btn view-btn">
        View
    </a>
    <a href="uploads/<?php echo $row['file_name']; ?>" download class="btn download-btn">
        Download
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

<a href="reject_certificate.php?id=<?= $row['id'] ?>" 
   class="btn reject-btn"
   onclick="return confirm('Are you sure you want to reject this certificate?')">
   Reject
</a>

<?php } else {
echo " ";
} ?>
</td>

</tr>

<?php } ?>

</table>

<br>
<a class="back" href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
