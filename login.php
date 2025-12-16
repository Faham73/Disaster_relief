<?php
session_start();

// If already logged in → redirect by role
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: dashboard.php");
    } else {
        header("Location: volunteer_dashboard.php");
    }
    exit();
}

include 'config.php';
include 'header.php';

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query  = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user   = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        // ✅ STORE USER AS SINGLE ARRAY
        $_SESSION['user'] = [
            'id'   => $user['id'],
            'name' => $user['name'],
            'role' => $user['role'],
            'email'=> $user['email']
        ];

        // ✅ ROLE-BASED REDIRECT
        if ($user['role'] === 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: volunteer_dashboard.php");
        }
        exit();

    } else {
        $error = "Invalid email or password";
    }
}
?>

<style>
    body {
        background: linear-gradient(135deg, #dc3545, #842029);
        min-height: 100vh;
    }

    .login-card {
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, .2);
    }

    .login-icon {
        width: 70px;
        height: 70px;
        background: #dc3545;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin: -50px auto 20px;
    }
</style>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="col-md-4 col-lg-4">

        <div class="card login-card p-4">

            <div class="login-icon">🚑</div>

            <h4 class="text-center fw-bold mb-3">
                Disaster Relief System
            </h4>
            <p class="text-center text-muted mb-4">
                Sign in to manage relief operations
            </p>

            <?php if (isset($error)) : ?>
                <div class="alert alert-danger text-center">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <input type="email" name="email"
                           class="form-control form-control-lg"
                           placeholder="📧 Email Address"
                           required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password"
                           class="form-control form-control-lg"
                           placeholder="🔒 Password"
                           required>
                </div>

                <button name="login" class="btn btn-danger btn-lg w-100 fw-semibold">
                    Login
                </button>
            </form>

            <div class="text-center mt-3">
                <span class="text-dark">Don't have an account?</span>
                <a href="register.php" class="fw-semibold text-warning text-decoration-none">
                    Register here
                </a>
            </div>

            <div class="text-center mt-4 text-muted small">
                © <?= date('Y'); ?> Disaster Relief Management System
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>
