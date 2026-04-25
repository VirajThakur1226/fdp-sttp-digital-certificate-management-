<?php
include("db.php");

if(isset($_POST['register']))
{
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $contact_no = $_POST['contact_no'];
    $department = $_POST['department'];

    if($name != "" && $email != "" && $password != "" && $contact_no != "" && $department != "")
    {
        // Check if email already exists
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");

        if(mysqli_num_rows($check) > 0)
        {
            echo "<script>alert('This email is already registered. Please use a different email or login.'); window.history.back();</script>";
        }
        else
        {
            $sql = "INSERT INTO users (name, email, password, contact_no, department) 
                    VALUES ('$name', '$email', '$password', '$contact_no', '$department')";

            if(mysqli_query($conn, $sql))
            {
                echo "<script>alert('Registration Successful'); window.location='user_login.php';</script>";
            }
            else
            {
                echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('All fields are required'); window.history.back();</script>";
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

select{
    width:100%;
    padding:8px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:4px;
    font-size:14px;
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
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Contact Number</label>
<input type="text" name="contact_no" 
   pattern="[0-9]{10}" placeholder="Enter 10 digit number" required>

<label>Department</label>
<select name="department" required>
    <option value="">-- Select Department --</option>
    <option value="Computer Engineering">Computer Engineering</option>
    <option value="Information Technology">Information Technology</option>
    <option value="Electronics & Telecommunication">Electronics & Telecommunication</option>
    <option value="Mechanical Engineering">Mechanical Engineering</option>
    <option value="Civil Engineering">Civil Engineering</option>
    <option value="Electrical Engineering">Electrical Engineering</option>
</select>

<label>Password</label>
<input type="password" name="password" required>

<button type="submit" name="register">Register</button>

</form>

<div class="footer">
Already have account? <a href="user_login.php">Login</a>
</div>

</div>

</body>
</html>
