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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

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
            <h5>Your Certificates</h5>
        </div>
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Program Title</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                while($row = mysqli_fetch_assoc($result))
                {
                    $duration = (strtotime($row['end_date']) - strtotime($row['start_date'])) / (60*60*24);
                ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['program_type']; ?></td>
                        <td><?php echo $duration; ?> Days</td>
                        <td>
                            <?php
                            if($row['status'] == "Pending")
                                echo "<span class='badge bg-warning'>Pending</span>";
                            elseif($row['status'] == "Approved")
                                echo "<span class='badge bg-success'>Approved</span>";
                            else
                                echo "<span class='badge bg-danger'>Rejected</span>";
                            ?>
                        </td>
                        <td>
                            <a href="uploads/<?php echo $row['file_path']; ?>" 
                               target="_blank" class="btn btn-info btn-sm">
                               View
                            </a>
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