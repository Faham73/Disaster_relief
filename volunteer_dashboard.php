<?php
session_start();

/*
|--------------------------------------------------------------------------
| AUTH GUARD
|--------------------------------------------------------------------------
*/
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'volunteer') {
    header("Location: login.php");
    exit();
}

include 'header.php';

$user = $_SESSION['user'];
?>

<div class="page-title mb-4">
    Welcome, <?= htmlspecialchars($user['name']); ?> 👋
</div>

<p class="text-muted mb-4">
    View your assigned disasters and track your relief activities.
</p>

<div class="row g-4">

    <!-- ASSIGNED DISASTERS -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-3 me-2"></i>
                    <h5 class="fw-bold mb-0">Assigned Disasters</h5>
                </div>
                <p class="text-muted">
                    See the disaster areas you are currently assigned to.
                </p>
                <a href="volunteer_assign.php" class="btn btn-danger">
                    View Assignments
                </a>
            </div>
        </div>
    </div>

    <!-- DISTRIBUTIONS -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-truck text-primary fs-3 me-2"></i>
                    <h5 class="fw-bold mb-0">Relief Distributions</h5>
                </div>
                <p class="text-muted">
                    Track the relief supplies you have delivered.
                </p>
                <a href="view_distribution.php" class="btn btn-outline-primary">
                    View Distributions
                </a>
            </div>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>
