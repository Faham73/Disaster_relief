<?php
// create_admin.php
// Run once from browser or CLI to create admin user with hashed password.

include 'config.php';

$name = "Admin";
$email = "admin@example.com";
$password_plain = "admin123"; // change this to a secure password immediately
$role = "admin";

$hashed = password_hash($password_plain, PASSWORD_DEFAULT);

// check if admin exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo "Admin already exists. Delete the user first if you want to recreate.";
    exit;
}
$stmt->close();

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $hashed, $role);
if($stmt->execute()){
    echo "Admin created. Email: $email Password: $password_plain (change this ASAP)";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
