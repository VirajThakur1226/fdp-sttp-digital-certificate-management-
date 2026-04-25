<?php
session_start();
include("db.php");
if(!isset($_SESSION['user_id']))
{
    header("Location: user_login.php");
}
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
// Fetch certificates of logged-in user
$sql = "SELECT * FROM certificates WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #eef2f7, #d9e4f5);
            font-family: 'Segoe UI', sans-serif;
        }
        h4 {
            font-weight: 600;
            color: #333;
        }
        .card {
            border-radius: 12px;
            border: none;
            overflow: hidden;
        }
        .card-header {
            border-radius: 12px 12px 0 0;
            font-weight: 600;
            font-size: 18px;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            background-color: #f8f9fa;
            text-align: center;
        }
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table tr:hover {
            background-color: #f1f5ff;
            transition: 0.2s;
        }

        .btn {
            border-radius: 8px;
        }

        .btn-primary {
            background: #4e73df;
            border: none;
        }

        .btn-primary:hover {
            background: #2e59d9;
        }

        .btn-danger {
            border-radius: 8px;
        }

        a {
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        .badge {
            padding: 6px 10px;
            font-size: 13px;
        }

        .card-body {
            padding: 20px;
        }

        .container {
            max-width: 1000px;
        }
        .action-btn {
    margin: 2px;
    border-radius: 6px;
    font-size: 12px;
    padding: 5px 10px;
}

.btn-info {
    background-color: #36b9cc;
    border: none;
    color: white;
}

.btn-info:hover {
    background-color: #2c9faf;
}

.btn-success {
    background-color: #1cc88a;
    border: none;
}

.btn-success:hover {
    background-color: #17a673;
}

.btn-warning {
    background-color: #f6c23e;
    border: none;
    color: black;
}

.btn-warning:hover {
    background-color: #dda20a;
}
    </style>
</head>
<body>
<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center">
        <h4>Welcome, <?php echo $user_name; ?></h4>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
    <hr>
    <!-- Upload Button -->
    <div class="mb-3">
        <a href="upload_certificate.php" class="btn btn-primary">
            Upload Certificate
        </a>
    </div>
    <!-- Certificate Table -->
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Your Certificates</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Program Title</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result))
                {
                    $duration = (strtotime($row['end_date']) - strtotime($row['start_date'])) / (60*60*24);
                ?>
                    <tr>
                        <td><?php echo $row['event_name']; ?></td>
                        <td><?php echo $row['program_type']; ?></td>
                        <td><?php echo $duration; ?> Days</td>
                        <td>
<?php
if($row['status'] == "Pending")
    echo "<span class='badge bg-warning'>Pending</span>";
elseif($row['status'] == "Approved")
    echo "<span class='badge bg-success'>Approved</span>";
else {
    echo "<span class='badge bg-danger'>Rejected</span>";

    // Show reason
    if(!empty($row['rejection_reason'])){
        echo "<br><small style='color:red;'>Reason: ".$row['rejection_reason']."</small>";
    }
}
?>
</td>

                        <td>
    <a href="uploads/<?php echo $row['file_name']; ?>" target="_blank" 
       class="btn btn-sm btn-info action-btn">View</a>

    <a href="uploads/<?php echo $row['file_name']; ?>" download 
       class="btn btn-sm btn-success action-btn">Download</a>

    <?php if($row['status'] == "Rejected") { ?>
        <a href="edit_certificate.php?id=<?php echo $row['id']; ?>" 
           class="btn btn-sm btn-warning action-btn">Edit</a>
    <?php } ?>
</td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
