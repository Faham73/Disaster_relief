<?php
include 'config.php';
include 'header.php';

$message = "";

if (isset($_POST['register'])) {

    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger text-center'>Email already exists!</div>";
    } else {

        $query = "INSERT INTO users (name, email, password, role)
                  VALUES ('$name', '$email', '$password', '$role')";

        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert alert-success text-center'>
                        Registration successful! Redirecting to login...
                        </div>";
            echo "<meta http-equiv='refresh' content='2;url=login.php'>";
        } else {
            $message = "<div class='alert alert-danger text-center'>Registration failed!</div>";
        }
    }
}
?>

<style>
    body {
        background: linear-gradient(135deg, #dc3545, #842029);
        min-height: 100vh;
    }
    .register-card {
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0,0,0,.2);
    }
</style>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="col-md-5">

        <div class="card register-card p-4">

            <h4 class="text-center fw-bold mb-2">
                Disaster Relief Registration
            </h4>

            <p class="text-center text-muted mb-4">
                Create an account to support relief operations
            </p>

            <?php echo $message; ?>

            <form method="POST">

                <div class="mb-3">
                    <input type="text" name="name"
                           class="form-control form-control-lg"
                           placeholder="👤 Full Name"
                           required>
                </div>

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

                <div class="mb-4">
                    <select name="role" class="form-select form-select-lg" required>
                        <option value="">Select Role</option>
                        <option value="volunteer">Volunteer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" name="register"
                        class="btn btn-danger btn-lg w-100 fw-semibold">
                    Register
                </button>
            </form>

            <div class="text-center mt-4">
                Already have an account?
                <a href="login.php" class="fw-semibold text-danger text-decoration-none">
                    Login
                </a>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
