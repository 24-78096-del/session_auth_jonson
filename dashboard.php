<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['user'];
$result = $conn->query("SELECT * FROM user WHERE username='$username'");
$userData = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Dashboard - SessionAuthSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <span class="bg-primary text-white rounded p-1 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </span>
                SessionAuthSystem
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small">Signed in as <strong class="text-dark"><?php echo htmlspecialchars($username); ?></strong></span>
                <a href="logout.php" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Log out
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container py-5">
        
        <!-- Blue Banner Card -->
        <div class="card text-white bg-primary border-0 rounded-4 p-4 p-md-5 mb-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
            <div class="card-body p-0 z-1">
                <span class="text-uppercase tracking-wider small fw-semibold text-white-50 d-block mb-1">PROTECTED DASHBOARD</span>
                <h1 class="display-5 fw-bold mb-2">Welcome, <?php echo htmlspecialchars($username); ?>.</h1>
                <p class="lead text-white-50 mb-3">This page is protected and only visible to logged-in users.</p>
                <div class="d-flex align-items-center gap-2 text-white-50 small">
                    <i class="fa-solid fa-shield-heart"></i>
                    <span>Your session is active and protected against session fixation.</span>
                </div>
            </div>
        </div>

        <!-- Middle Info Cards Row -->
        <div class="row g-4 mb-4">
            <!-- Account Status -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small d-block mb-1">Account status</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="spinner-grow spinner-grow-sm text-success" role="status" style="width: 8px; height: 8px;"></span>
                                <h5 class="fw-bold mb-0 text-dark">Active</h5>
                            </div>
                            <span class="text-muted small mt-1 d-block">Your session is active</span>
                        </div>
                        <div class="text-muted bg-light p-3 rounded-3">
                            <i class="fa-solid fa-circle-check text-success fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User ID Card -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small d-block mb-1">User ID</span>
                            <h5 class="fw-bold mb-0 text-dark">#<?php echo isset($userData['id']) ? $userData['id'] : '1'; ?></h5>
                            <span class="text-muted small mt-1 d-block">Unique account identifier</span>
                        </div>
                        <div class="text-muted bg-light p-3 rounded-3">
                            <i class="fa-solid fa-id-badge fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Session Security Card -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small d-block mb-1">Session security</span>
                            <h5 class="fw-bold mb-0 text-dark">Protected</h5>
                            <span class="text-muted small mt-1 d-block">Regenerated after login</span>
                        </div>
                        <div class="text-muted bg-light p-3 rounded-3">
                            <i class="fa-solid fa-shield-virus fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Details Row -->
        <div class="row g-4">
            <!-- User Details Card -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 50px; height: 50px;">
                                <?php echo strtoupper(substr($username, 0, 1)); ?>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">User details</h5>
                                <span class="text-muted small">Information linked to this account.</span>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <span class="text-muted small d-block">User ID</span>
                                <span class="fw-semibold">#<?php echo isset($userData['id']) ? $userData['id'] : '1'; ?></span>
                            </div>
                            <div class="col-6">
                                <span class="text-muted small d-block">Username</span>
                                <span class="fw-semibold">@<?php echo htmlspecialchars($username); ?></span>
                            </div>
                            <div class="col-6 mt-3">
                                <span class="text-muted small d-block">Email address</span>
                                <span class="fw-semibold"><?php echo isset($userData['email']) ? htmlspecialchars($userData['email']) : 'N/A'; ?></span>
                            </div>
                            <div class="col-6 mt-3">
                                <span class="text-muted small d-block">Created at</span>
                                <span class="fw-semibold"><?php echo isset($userData['create_at']) ? htmlspecialchars($userData['create_at']) : date('M j, Y • g:i A'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Session ID Card -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="fa-solid fa-network-wired text-primary"></i>
                            <h5 class="fw-bold mb-0">Active Session ID</h5>
                        </div>
                        <span class="text-muted small d-block mb-3">Current session ID</span>

                        <div class="bg-light p-3 rounded-3 font-monospace small text-break border mb-3">
                            <?php echo session_id(); ?>
                        </div>

                        <div class="d-flex align-items-start gap-2 text-muted small bg-body-tertiary p-3 rounded-3">
                            <i class="fa-solid fa-lock mt-1 text-primary"></i>
                            <span>Generated after login using <code>session_regenerate_id(true)</code> to protect against session fixation.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>