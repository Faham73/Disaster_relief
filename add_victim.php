<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';
include 'header.php';

$msg = "";
$err = "";

if (isset($_POST['submit'])) {

    $disaster_id = intval($_POST['disaster_id']);
    $name        = trim($_POST['name']);
    $age         = intval($_POST['age']);
    $contact     = trim($_POST['contact']);
    $address     = trim($_POST['address']);

    if ($disaster_id && $name !== "") {

        $stmt = $conn->prepare(
            "INSERT INTO victims (disaster_id, name, age, contact, address)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("isiss", $disaster_id, $name, $age, $contact, $address);

        if ($stmt->execute()) {
            $msg = "✅ Victim added successfully.";
        } else {
            $err = "❌ Failed to add victim.";
        }
        $stmt->close();

    } else {
        $err = "Please fill all required fields.";
    }
}

$disasters = $conn->query(
    "SELECT id, name, location FROM disasters ORDER BY date DESC"
);
?>

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-people-fill me-2"></i>
                        Add Victim
                    </h5>
                </div>

                <div class="card-body p-4">

                    <?php if ($msg): ?>
                        <div class="alert alert-success"><?= $msg ?></div>
                    <?php endif; ?>

                    <?php if ($err): ?>
                        <div class="alert alert-danger"><?= $err ?></div>
                    <?php endif; ?>

                    <form method="post">

                        <!-- DISASTER -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Disaster <span class="text-danger">*</span>
                            </label>
                            <select name="disaster_id" class="form-select" required>
                                <option value="">Select Disaster</option>
                                <?php while ($d = $disasters->fetch_assoc()): ?>
                                    <option value="<?= $d['id'] ?>">
                                        <?= htmlspecialchars($d['name']) ?> — <?= htmlspecialchars($d['location']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- NAME -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Victim Name <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   name="name"
                                   placeholder="Enter full name"
                                   required>
                        </div>

                        <!-- AGE -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Age</label>
                            <input type="number"
                                   class="form-control"
                                   name="age"
                                   placeholder="Age">
                        </div>

                        <!-- CONTACT -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contact</label>
                            <input type="text"
                                   class="form-control"
                                   name="contact"
                                   placeholder="Phone number">
                        </div>

                        <!-- ADDRESS -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea class="form-control"
                                      name="address"
                                      rows="3"
                                      placeholder="Current address"></textarea>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" name="submit">
                                <i class="bi bi-plus-circle me-2"></i>
                                Add Victim
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

<?php include 'footer.php'; ?>
