<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO user (username, password_hash) VALUES ('$u', '$p')");
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - System Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

    <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center text-success mb-4 fw-bold">Create Account</h3>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control rounded-3" placeholder="Choose a username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control rounded-3" placeholder="Create a password" required>
                </div>
                <button type="submit" class="btn btn-success w-100 py-2 rounded-3 mt-2 fw-semibold">Register</button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted mb-0">May account ka na? <a href="index.php" class="text-success text-decoration-none fw-bold">Login dito</a></p>
            </div>
        </div>
    </div>

</body>
</html>