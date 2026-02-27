<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FDP/STTP Certificate Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero {
            padding: 80px 0;
            background: linear-gradient(to right, #2563eb, #1e40af);
            color: white;
            text-align: center;
        }
        .feature-card {
            transition: 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        footer {
            background-color: #1e40af;
            color: white;
            padding: 15px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">FDP Certificate System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_login.php">User Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_login.php">Admin Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ================= HERO SECTION ================= -->
<section class="hero">
    <div class="container">
        <h1 class="fw-bold">Web-Based FDP/STTP Certificate Management System</h1>
        <p class="lead mt-3">
            A secure platform to upload, manage and verify academic training certificates efficiently.
        </p>
        <a href="register.php" class="btn btn-light btn-lg mt-3">Get Started</a>
    </div>
</section>

<!-- ================= FEATURES SECTION ================= -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">

            <div class="col-md-3">
                <div class="card feature-card shadow-sm p-3">
                    <h5 class="fw-bold">Secure Login</h5>
                    <p>User and Admin authentication system.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card feature-card shadow-sm p-3">
                    <h5 class="fw-bold">Certificate Upload</h5>
                    <p>Upload FDP/STTP certificates with validation.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card feature-card shadow-sm p-3">
                    <h5 class="fw-bold">Admin Verification</h5>
                    <p>Admin can approve or reject certificates.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card feature-card shadow-sm p-3">
                    <h5 class="fw-bold">Status Tracking</h5>
                    <p>Users can track approval status in dashboard.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer>
    <div class="container">
        <p class="mb-0">
            © 2026 FDP/STTP Certificate Management System | Developed by Your Name
        </p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>