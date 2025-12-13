<?php
include 'header.php';
include 'config.php';

if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }

$msg = ""; $err = "";
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $quantity = intval($_POST['quantity']);
    $description = trim($_POST['description']);

    if ($name === "" || $quantity < 0) {
        $err = "Provide resource name and non-negative quantity.";
    } else {
        $stmt = $conn->prepare("INSERT INTO resources (name, quantity, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $quantity, $description);
        if ($stmt->execute()) $msg = "Resource added.";
        else $err = "DB error: " . $stmt->error;
        $stmt->close();
    }
}
?>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Add Resource</h5>
      </div>
      <div class="card-body">
        <?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
        <?php if ($err): ?><div class="alert alert-danger"><?= htmlspecialchars($err) ?></div><?php endif; ?>

        <form method="post" autocomplete="off">
          <div class="mb-2">
            <label class="form-label">Resource Name</label>
            <input type="text" name="name" class="form-control" placeholder="Ex: Bottled Water" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Quantity (total units)</label>
            <input type="number" name="quantity" min="0" class="form-control" value="0" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description (optional)</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>

          <button name="submit" class="btn btn-warning w-100">Add Resource</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
