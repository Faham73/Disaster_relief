<?php
include 'header.php';
include 'config.php';

// Default filters
$search = $_GET['search'] ?? '';
$start_date = $_GET['start'] ?? '';
$end_date   = $_GET['end'] ?? '';

// Build SQL Query
$sql = "
SELECT d.id, v.name AS victim_name, r.name AS resource_name, d.quantity_given, d.date, 
       d.status, u.name AS volunteer_name, dis.name AS disaster_name
FROM distribution d
LEFT JOIN victims v ON d.victim_id = v.id
LEFT JOIN resources r ON d.resource_id = r.id
LEFT JOIN users u ON d.volunteer_id = u.id
LEFT JOIN disasters dis ON v.disaster_id = dis.id
WHERE 1=1
";

// Extra conditions based on filters
if (!empty($search)) {
    $sql .= " 
    AND (
        v.name LIKE '%$search%' OR 
        r.name LIKE '%$search%' OR 
        dis.name LIKE '%$search%' OR 
        u.name LIKE '%$search%'
    )";
}

if (!empty($start_date) && !empty($end_date)) {
    $sql .= " AND d.date BETWEEN '$start_date' AND '$end_date' ";
}

$sql .= " ORDER BY d.date DESC";

// Execute
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

    <div class="card shadow-lg border-0 mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">View Distributions</h4>
        </div>

        <div class="card-body">

            <!-- Search & Filter Section -->
            <form class="row g-3 mb-4" method="GET">

                <div class="col-md-4">
                    <label class="form-label">Search (Victim, Resource, Disaster, Volunteer)</label>
                    <input type="text" name="search" class="form-control" placeholder="Type keyword..."
                        value="<?= $search ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start" class="form-control" value="<?= $start_date ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end" class="form-control" value="<?= $end_date ?>">
                </div>

                <div class="col-md-2">
                    <label class="form-label d-block">&nbsp;</label>
                    <button class="btn btn-primary w-100">Filter</button>
                </div>

            </form>

            <!-- SQL Query Info (Debugging / Transparency) -->
            <!-- <div class="alert alert-info small">
                <strong>SQL Query Used:</strong> <br>
                <code><?= htmlspecialchars($sql) ?></code>
            </div> -->

            <!-- Distribution Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Victim</th>
                            <th>Resource</th>
                            <th>Disaster</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Volunteer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (mysqli_num_rows($result) > 0):
                            $sl = 1;
                            while ($row = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= $row['victim_name'] ?></td>
                            <td><?= $row['resource_name'] ?></td>
                            <td><?= $row['disaster_name'] ?></td>
                            <td><?= $row['quantity_given'] ?></td>
                            <td><?= $row['date'] ?></td>

                            <td>
                                <?php if ($row['status'] == "Delivered"): ?>
                                    <span class="badge bg-success">Delivered</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php endif; ?>
                            </td>

                            <td><?= $row['volunteer_name'] ?></td>
                        </tr>

                        <?php endwhile; else: ?>

                        <tr>
                            <td colspan="8" class="text-center text-muted">No records found...</td>
                        </tr>

                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<?php include 'footer.php'; ?>
