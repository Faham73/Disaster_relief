<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Disaster Relief Resource Management</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navbar-height: 60px;
            --sidebar-width: 250px;
        }

        body {
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        /* TOP NAVBAR */
        .navbar {
            height: var(--navbar-height);
            z-index: 1000;
            position: fixed;
            top: 0;
            width: 100%;
        }

        /* FIXED SIDEBAR */
        .sidebar {
            position: fixed;
            top: var(--navbar-height);  /* FIXED OVERLAPPING */
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--navbar-height));
            background: #1a2530;
            padding-top: 10px;
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            padding: 12px 22px;
            color: #cfd8dc;
            text-decoration: none;
            border-bottom: 1px solid #22303d;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #0d6efd;
            color: white;
        }

        /* MAIN CONTENT */
        .content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            margin-top: var(--navbar-height); /* FIXED OVERLAPPING */
        }

        .page-title {
            font-weight: 600;
            font-size: 22px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark px-3 shadow-sm">
    <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
        <i class="bi bi-life-preserver me-2"></i>
        Disaster Relief Admin
    </a>

    <div class="d-flex align-items-center">
        <?php if(isset($_SESSION['name'])): ?>
            <span class="text-white me-3">
                <i class="bi bi-person-circle"></i> <?= $_SESSION['name']; ?>
            </span>
        <?php endif; ?>

        <a href="logout.php" class="btn btn-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</nav>

<!-- SIDEBAR -->
<div class="sidebar">

    <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <a href="add_disaster.php" class="<?= basename($_SERVER['PHP_SELF']) == 'add_disaster.php' ? 'active' : '' ?>">
        <i class="bi bi-exclamation-triangle me-2"></i> Add Disaster
    </a>

    <a href="add_resource.php" class="<?= basename($_SERVER['PHP_SELF']) == 'add_resource.php' ? 'active' : '' ?>">
        <i class="bi bi-box-seam me-2"></i> Add Resource
    </a>

    <a href="add_victim.php" class="<?= basename($_SERVER['PHP_SELF']) == 'add_victim.php' ? 'active' : '' ?>">
        <i class="bi bi-people-fill me-2"></i> Add Victim
    </a>

    <a href="distribute.php" class="<?= basename($_SERVER['PHP_SELF']) == 'distribute.php' ? 'active' : '' ?>">
        <i class="bi bi-hand-index-thumb me-2"></i> Distribute Resources
    </a>

    <a href="view_distribution.php" class="<?= basename($_SERVER['PHP_SELF']) == 'view_distribution.php' ? 'active' : '' ?>">
        <i class="bi bi-table me-2"></i> View Distribution
    </a>

    <a href="volunteer_assign.php" class="<?= basename($_SERVER['PHP_SELF']) == 'volunteer_assign.php' ? 'active' : '' ?>">
        <i class="bi bi-person-check me-2"></i> Assign Volunteer
    </a>

</div>

<!-- PAGE CONTENT -->
<div class="content">
