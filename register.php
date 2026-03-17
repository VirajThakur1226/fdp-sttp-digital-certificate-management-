<?php
include("db.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($name == "" || $email == "" || $password == ""){
        echo "<script>alert('All fields are required');</script>";
    }
    else{
        $sql = "INSERT INTO users (name,email,password)
                VALUES ('$name','$email','$password')";

        if(mysqli_query($conn,$sql)){
            echo "<script>alert('Registration Successful'); window.location='user_login.php';</script>";
        }else{
            echo "<script>alert('Error in registration');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Registration</title>

<style>

body{
    font-family: Arial;
    background:#f2f2f2;
}

.container{
    width:350px;
    margin:100px auto;
    background:white;
    padding:25px;
    border-radius:8px;
    box-shadow:0px 0px 10px #ccc;
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
    background:#007bff;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#0056b3;
}

a{
    text-decoration:none;
    color:#007bff;
}

.footer{
    text-align:center;
    margin-top:10px;
}

</style>

</head>

<body>

<div class="container">

<h2>User Registration</h2>

<form method="POST">

<label>Full Name</label>
<input type="text" name="name">

<label>Email</label>
<input type="email" name="email">

<label>Password</label>
<input type="password" name="password">

<button type="submit" name="register">Register</button>

</form>

<div class="footer">
Already have account? <a href="user_login.php">Login</a>
</div>

</div>

</body>
</html>