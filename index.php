<!DOCTYPE html>
<html>
<head>
    <title>FDP/STTP Certificate Management</title>
    <style>
        body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f6f9;
}

/* NAVBAR */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #1f4db8;
    padding: 15px 50px;
    color: white;
}

.logo {
    font-size: 18px;
    font-weight: bold;
}

.nav-links a {
    color: white;
    margin-left: 20px;
    text-decoration: none;
    font-size: 14px;
}

.nav-links a:hover {
    text-decoration: underline;
}

/* HERO */
.hero {
    text-align: center;
    padding: 100px 20px;
    background: linear-gradient(to right, #2a6cf0, #1f4db8);
    color: white;
}

.hero h1 {
    font-size: 32px;
    margin-bottom: 15px;
}

.hero p {
    font-size: 16px;
    margin-bottom: 25px;
}

.btn {
    padding: 10px 20px;
    background: white;
    color: #1f4db8;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.btn:hover {
    background: #e0e0e0;
}

/* FEATURES */
.features {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 60px 20px;
}

.card {
    background: white;
    padding: 25px;
    width: 220px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
}

.card h3 {
    margin-bottom: 10px;
    color: #1f4db8;
}

.card p {
    font-size: 14px;
    color: #555;
}

/* FOOTER */
footer {
    text-align: center;
    padding: 15px;
    background: #1f4db8;
    color: white;
    font-size: 14px;
}
</style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="logo">FDP Certificate System</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="register.php">Register</a>
        <a href="user_login.php">User Login</a>
        <a href="admin_login.php">Admin Login</a>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <h1>Web-Based FDP/STTP Certificate Management System</h1>
    <p>Upload, verify and manage academic training certificates digitally.</p>
    <a href="register.php" class="btn">Get Started</a>
</section>

<!-- Features Section -->
<section class="features">
    <div class="card">
        <h3>Secure Login</h3>
        <p>User and Admin authentication system.</p>
    </div>

    <div class="card">
        <h3>Certificate Upload</h3>
        <p>Upload FDP/STTP certificates with validation.</p>
    </div>

    <div class="card">
        <h3>Admin Verification</h3>
        <p>Approve or reject certificates easily.</p>
    </div>

    <div class="card">
        <h3>Status Tracking</h3>
        <p>Users can track approval status.</p>
    </div>
</section>

<!-- Footer -->
<footer>
    © 2026 FDP/STTP Certificate Management System | Developed by Your Name
</footer>

</body>
</html>