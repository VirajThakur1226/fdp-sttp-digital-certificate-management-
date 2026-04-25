<?php
include("db.php");

$id = $_GET['id'];
?>

<html>
<head>
<style>

body{
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 0;
}

.form-box{
    width: 400px;
    margin: 60px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.form-box h2{
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.form-box label{
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

.form-box textarea{
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-box button{
    width: 100%;
    margin-top: 15px;
    padding: 10px;
    background: #e74c3c;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.form-box button:hover{
    background: #c0392b;
}

.back-link{
    display: block;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
    color: #555;
}

</style>
</head>

<body>

<div class="form-box">

<h2>Reject Certificate</h2>

<form method="POST">

<label>Reason for Rejection</label>
<textarea name="reason" required></textarea>

<button type="submit" name="submit">Submit</button>

</form>

<a href="manage_certificates.php" class="back-link">Back</a>

</div>

<?php
if(isset($_POST['submit'])){
    $reason = $_POST['reason'];

    mysqli_query($conn, "UPDATE certificates 
        SET status='Rejected', rejection_reason='$reason' 
        WHERE id='$id'");

    header("Location: manage_certificates.php");
}
?>

</body>
</html>