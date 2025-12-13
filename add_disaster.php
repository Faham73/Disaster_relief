<?php
include 'header.php';
include 'config.php';

if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }

$msg = "";
$err = "";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $location = trim($_POST['location']);
    $severity = trim($_POST['severity']);
    $date = $_POST['date'];

    if ($name === "" || $location === "" || $severity === "" || $date === "") {
        $err = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO disasters (name, location, severity, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $location, $severity, $date);
        if ($stmt->execute()) $msg = "Disaster added successfully.";
        else $err = "Database error: " . $stmt->error;
        $stmt->close();
    }
}
?>

<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Add New Disaster</h5>
      </div>
      <div class="card-body">
        <?php if ($msg): ?>
          <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <?php if ($err): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="off">
          <div class="mb-2">
            <label class="form-label">Disaster Name</label>
            <input type="text" name="name" class="form-control" placeholder="Ex: Flood 2025" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" placeholder="City / Area" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Severity</label>
            <select name="severity" class="form-control" required>
              <option value="">Select severity</option>
              <option>Low</option>
              <option>Moderate</option>
              <option>High</option>
              <option>Critical</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
          </div>

          <button name="submit" class="btn btn-primary w-100">Save Disaster</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
