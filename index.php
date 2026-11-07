<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $result = $conn->query("SELECT * FROM user WHERE username='$u'");
    if ($row = $result->fetch_assoc()) {
        if (password_verify($p, $row['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = $u;
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Maling username o password!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - System Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

    <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center text-primary mb-4 fw-bold">Welcome Back</h3>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger py-2 text-center" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control rounded-3" placeholder="Enter username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control rounded-3" placeholder="Enter password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 mt-2 fw-semibold">Login</button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted mb-0">Wala pang account? <a href="register.php" class="text-primary text-decoration-none fw-bold">Register dito</a></p>
            </div>
        </div>
    </div>

</body>
</html>