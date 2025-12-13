<?php
include 'config.php';

$message = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Email already exists!</div>";
    } else {
        $query = "INSERT INTO users(name,email,password,role)
                  VALUES ('$name','$email','$password','$role')";

        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert alert-success'>Registration successful! Redirecting to login...</div>";
            echo "<meta http-equiv='refresh' content='2;url=login.php'>";
        } else {
            $message = "<div class='alert alert-danger'>Error: Could not register.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5 w-50">
    <h3 class="text-center mb-4">User Registration</h3>

    <?php echo $message; ?>

    <div class="card p-4 shadow">
        <form method="POST">

            <label>Name:</label>
            <input type="text" name="name" class="form-control mb-3" required>

            <label>Email:</label>
            <input type="email" name="email" class="form-control mb-3" required>

            <label>Password:</label>
            <input type="password" name="password" class="form-control mb-3" required>

            <label>Role:</label>
            <select name="role" class="form-control mb-3">
                <option value="admin">Admin</option>
                <option value="volunteer">Volunteer</option>
            </select>

            <button type="submit" name="register" class="btn btn-primary w-100">
                Register
            </button>

        </form>

        <p class="text-center mt-3">
            Already have an account?
            <a href="login.php">Login</a>
        </p>
    </div>
</div>

</body>
</html>
