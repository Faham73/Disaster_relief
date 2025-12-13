<?php
include 'header.php';
include 'config.php';

if(!$user){ header("Location: login.php"); exit; }

if(isset($_POST['submit'])){
    $disaster_id = intval($_POST['disaster_id']);
    $name = trim($_POST['name']);
    $age = intval($_POST['age']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);

    $stmt = $conn->prepare("INSERT INTO victims (disaster_id,name,age,contact,address) VALUES (?,?,?,?,?)");
    $stmt->bind_param("isiss",$disaster_id,$name,$age,$contact,$address);
    $stmt->execute();
    $msg = "Victim added successfully.";
}

$disasters = $conn->query("SELECT id,name,location FROM disasters ORDER BY date DESC");
?>

<h3>Add Victim</h3>
<?php if(isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>

<form method="post">

  <div class="mb-2">
    <label>Disaster</label>
    <select name="disaster_id" class="form-control" required>
      <option value="">Select</option>
      <?php while($d = $disasters->fetch_assoc()): ?>
        <option value="<?= $d['id'] ?>"><?= $d['name']." - ".$d['location'] ?></option>
      <?php endwhile; ?>
    </select>
  </div>

  <input class="form-control mb-2" name="name" placeholder="Victim Name" required>
  <input class="form-control mb-2" type="number" name="age" placeholder="Age">
  <input class="form-control mb-2" name="contact" placeholder="Contact">
  <textarea class="form-control mb-2" name="address" placeholder="Address"></textarea>

  <button class="btn btn-primary" name="submit">Add</button>
</form>

<?php include 'footer.php'; ?>
