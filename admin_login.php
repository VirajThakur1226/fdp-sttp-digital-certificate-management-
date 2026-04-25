<?php
session_start();
include("db.php");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1)
    {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
    }
    else
    {
        echo "<script>alert('Invalid Admin Credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>

body{
    font-family: Arial;
    background:#f2f2f2;
}

.container{
    width:350px;
    margin:120px auto;
    background:white;
    padding:25px;
    border-radius:8px;
    box-shadow:0 0 10px #ccc;
}

h2{
    text-align:center;
}

input{
    width:100%;
    padding:8px;
    margin-top:5px;
    margin-bottom:15px;
}

button{
    width:100%;
    padding:10px;
    background:#dc3545;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#b02a37;
}

.footer{
    text-align:center;
    margin-top:10px;
}

a{
    text-decoration:none;
    color:#007bff;
}

</style>

</head>

<body>

<div class="container">

<h2>Admin Login</h2>

<form method="POST">

<label>Username</label>
<input type="text" name="username" required>

<label>Password</label>
<input type="password" name="password" required>

<button type="submit" name="login">Login</button>

</form>

<div class="footer">
<a href="index.php">Back to Home</a>
</div>

</div>

</body>
</html>