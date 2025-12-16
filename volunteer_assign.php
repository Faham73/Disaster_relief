<?php
include 'header.php';
include 'config.php';

// if ($_SESSION['user']['role'] !== 'volunteer') {
//     header("Location: dashboard.php");
//     exit();
// }


$volunteers = $conn->query("SELECT id, name, email FROM users WHERE role='volunteer' ORDER BY name");
$disasters = $conn->query("SELECT id, name, location FROM disasters ORDER BY date DESC");

if (isset($_POST['assign'])) {
    $volunteer_id = intval($_POST['volunteer_id']);
    $disaster_id = intval($_POST['disaster_id']);

    if ($volunteer_id <= 0 || $disaster_id <= 0) $err = "Select both volunteer and disaster.";
    else {
        // prevent duplicate assignment
        $stmt = $conn->prepare("SELECT id FROM volunteer_assign WHERE volunteer_id=? AND disaster_id=?");
        $stmt->bind_param("ii", $volunteer_id, $disaster_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $err = "Volunteer already assigned to this disaster.";
        } else {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO volunteer_assign (volunteer_id, disaster_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $volunteer_id, $disaster_id);
            if ($stmt->execute()) $msg = "Volunteer assigned.";
            else $err = "DB error: " . $stmt->error;
        }
        if ($stmt) $stmt->close();
    }
}
?>

<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card shadow-sm">
      <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Assign Volunteer</h5>
      </div>
      <div class="card-body">
        
        <form method="post">
          <div class="mb-2">
            <label class="form-label">Volunteer</label>
            <select name="volunteer_id" class="form-control" required>
              <option value="">Select volunteer</option>
              <?php while ($v = $volunteers->fetch_assoc()): ?>
                <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['name'].' ('.$v['email'].')') ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Disaster</label>
            <select name="disaster_id" class="form-control" required>
              <option value="">Select disaster</option>
              <?php while ($d = $disasters->fetch_assoc()): ?>
                <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name'].' — '.$d['location']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <button name="assign" class="btn btn-secondary w-100">Assign</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
