<?php
session_start();
include("db.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];

        header("Location: user_dashboard.php");
    }
    else
    {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Login</title>

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
    background:#28a745;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#1e7e34;
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

<h2>User Login</h2>

<form method="POST">

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<button type="submit" name="login">Login</button>

</form>

<div class="footer">
Don't have account? <a href="register.php">Register</a>
</div>

</div>

</body>
</html>