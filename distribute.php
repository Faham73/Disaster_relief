<?php
include 'header.php';
include 'config.php';

if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }

$user = $_SESSION['user'];
$msg = ""; $err = "";

// Fetch lists
$victims = $conn->query("SELECT v.id, v.name, d.name AS disaster_name FROM victims v LEFT JOIN disasters d ON v.disaster_id=d.id ORDER BY v.name");
$resources = $conn->query("SELECT id, name, quantity FROM resources ORDER BY name");
$volunteers = $conn->query("SELECT id, name FROM users WHERE role='volunteer' ORDER BY name");

if (isset($_POST['distribute'])) {
    $victim_id = intval($_POST['victim_id']);
    $resource_id = intval($_POST['resource_id']);
    $qty = intval($_POST['quantity']);
    $volunteer_id = intval($_POST['volunteer_id']);
    $date = date('Y-m-d');

    if ($victim_id <= 0 || $resource_id <= 0 || $qty <= 0) {
        $err = "Select victim, resource and a positive quantity.";
    } else {
        // transaction-safe update
        $conn->begin_transaction();

        // lock resource row
        $stmt = $conn->prepare("SELECT quantity FROM resources WHERE id = ? FOR UPDATE");
        $stmt->bind_param("i", $resource_id);
        $stmt->execute();
        $stmt->bind_result($available);
        $stmt->fetch();
        $stmt->close();

        if ($available === null) {
            $conn->rollback();
            $err = "Resource not found.";
        } elseif ($available < $qty) {
            $conn->rollback();
            $err = "Not enough resource. Available: {$available}";
        } else {
            // insert distribution
            $stmt = $conn->prepare("INSERT INTO distribution (victim_id, resource_id, quantity_given, date, status, volunteer_id) VALUES (?, ?, ?, ?, 'Pending', ?)");
            $stmt->bind_param("iiisi", $victim_id, $resource_id, $qty, $date, $volunteer_id);
            if (!$stmt->execute()) {
                $conn->rollback();
                $err = "Insert error: " . $stmt->error;
            } else {
                $stmt->close();
                $newq = $available - $qty;
                $stmt = $conn->prepare("UPDATE resources SET quantity = ? WHERE id = ?");
                $stmt->bind_param("ii", $newq, $resource_id);
                if ($stmt->execute()) {
                    $conn->commit();
                    $msg = "Distribution recorded. Remaining: {$newq}.";
                } else {
                    $conn->rollback();
                    $err = "Update error: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}
?>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-header bg-info text-white">
        <h5 class="mb-0">Distribute Resource</h5>
      </div>

      <div class="card-body">
        <?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
        <?php if ($err): ?><div class="alert alert-danger"><?= htmlspecialchars($err) ?></div><?php endif; ?>

        <form method="post">
          <div class="mb-2">
            <label class="form-label">Victim</label>
            <select name="victim_id" class="form-control" required>
              <option value="">Select victim</option>
              <?php while ($v = $victims->fetch_assoc()): ?>
                <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['name'] . ' — ' . $v['disaster_name']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="mb-2">
            <label class="form-label">Resource</label>
            <select name="resource_id" class="form-control" required>
              <option value="">Select resource</option>
              <?php while ($r = $resources->fetch_assoc()): ?>
                <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['name'] . ' (Available: ' . $r['quantity'] . ')') ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">Quantity to give</label>
              <input type="number" name="quantity" class="form-control" min="1" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="form-label">Volunteer</label>
              <select name="volunteer_id" class="form-control">
                <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name']) ?> (You)</option>
                <?php while ($vv = $volunteers->fetch_assoc()): ?>
                  <option value="<?= $vv['id'] ?>"><?= htmlspecialchars($vv['name']) ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>

          <button name="distribute" class="btn btn-info w-100">Record Distribution</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
