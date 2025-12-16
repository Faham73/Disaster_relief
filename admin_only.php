<?php
include 'auth.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: volunteer_dashboard.php");
    exit();
}
