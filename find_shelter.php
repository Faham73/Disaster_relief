<?php
session_start();
include 'config.php';
include 'header.php';

/*
|--------------------------------------------------------------------------
| SEARCH LOGIC
|--------------------------------------------------------------------------
*/
$search = $_GET['search'] ?? '';

$sql = "
    SELECT *
    FROM shelters
    WHERE available_slots > 0
";

if (!empty($search)) {
    $safe = mysqli_real_escape_string($conn, $search);
    $sql .= " AND (location LIKE '%$safe%' OR name LIKE '%$safe%')";
}

$result = mysqli_query($conn, $sql);
?>

<div class="page-title mb-4">
    🏠 Find an Open Shelter
</div>

<p class="text-muted mb-4">
    View nearby shelters with available capacity.
</p>

<!-- SEARCH BAR -->
<form method="GET" class="row g-2 mb-4">
    <div class="col-md-8">
        <input type="text"
            name="search"
            value="<?= htmlspecialchars($search); ?>"
            class="form-control form-control-lg"
            placeholder="Search by location or shelter name">
    </div>
    <div class="col-md-4">
        <button class="btn btn-danger btn-lg w-100">
            🔍 Search Shelter
        </button>
    </div>
</form>

<!-- SHELTER LIST -->
<div class="row g-4">

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">

                        <h5 class="fw-bold mb-2">
                            <?= htmlspecialchars($row['name']); ?>
                        </h5>

                        <p class="mb-1">
                            <i class="bi bi-geo-alt-fill text-danger"></i>
                            <?= htmlspecialchars($row['location']); ?>
                        </p>

                        <p class="mb-1">
                            <i class="bi bi-people-fill text-primary"></i>
                            Capacity: <?= $row['capacity']; ?>
                        </p>

                        <p class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            Available Slots: <?= $row['available_slots']; ?>
                        </p>

                        <div class="d-flex align-items-center justify-content-between mt-3">

                            <div>
                                <i class="bi bi-telephone-fill"></i>
                                <?= htmlspecialchars($row['contact']); ?>
                            </div>

                            <a href="tel:<?= htmlspecialchars($row['contact']); ?>"
                                class="btn btn-success btn-sm">
                                <i class="bi bi-telephone-outbound"></i> Call Now
                            </a>

                        </div>


                        <span class="badge bg-success px-3 py-2">
                            Open
                        </span>

                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    <?php else: ?>

        <div class="col-12">
            <div class="alert alert-warning text-center">
                No open shelters found for this search.
            </div>
        </div>

    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>