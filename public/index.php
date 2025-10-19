<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include("../config/db.php");

// Capture search/filter input
$search = $_GET['search'] ?? '';
$location = $_GET['location'] ?? '';
$date = $_GET['date'] ?? '';

$sql = "SELECT * FROM events WHERE 1=1";
if(!empty($search)) $sql .= " AND title LIKE '%$search%'";
if(!empty($location)) $sql .= " AND location LIKE '%$location%'";
if(!empty($date)) $sql .= " AND event_date = '$date'";
$sql .= " ORDER BY event_date ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Event Management</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">🎉 Event Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item me-3">
          <span class="nav-link text-white">Welcome, <strong><?= $_SESSION['user_name'] ?></strong></span>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-4">
  <h2 class="text-center mb-4" style="color:#2c3e50;">🎉 Event Management System</h2>

 <!-- Search & Filter Form -->
<form method="GET" class="row g-2 mb-4">
  <div class="col-md-3">
    <input type="text" name="search" class="form-control" placeholder="Search by title" value="<?= htmlspecialchars($search) ?>">
  </div>
  <div class="col-md-3">
    <input type="text" name="location" class="form-control" placeholder="Filter by location" value="<?= htmlspecialchars($location) ?>">
  </div>
  <div class="col-md-3">
    <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date) ?>">
  </div>
  <div class="col-md-3 d-flex gap-2">
    <button class="btn btn-primary w-50">Search</button>
    <a href="index.php" class="btn btn-secondary w-50">Reset</a>
  </div>
</form>


  <div class="text-end mb-3">
    <a href="add_event.php" class="btn btn-warning text-white fw-bold" style="background-color:#8e44ad; border:none;">➕ Add New Event</a>
  </div>

  <div class="row">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "
        <div class='col-md-4 mb-4'>
          <div class='card shadow-lg border-0 h-100' style='border-radius:12px; transition: transform 0.3s, box-shadow 0.3s;'>
            <div class='card-body' style='background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color:white; border-radius:12px;'>
              <h5 class='card-title'>{$row['title']}</h5>
              <p class='card-text'>{$row['description']}</p>
              <p><strong>Date:</strong> {$row['event_date']}</p>
              <p><strong>Location:</strong> {$row['location']}</p>
              <a href='edit_event.php?id={$row['id']}' class='btn btn-light btn-sm text-primary fw-bold'>✏️ Edit</a>
              <a href='delete_event.php?id={$row['id']}' class='btn btn-danger btn-sm fw-bold' onclick='return confirm(\"Delete this event?\")'>🗑️ Delete</a>
            </div>
          </div>
        </div>
        ";
      }
    } else {
      echo "<p class='text-center text-muted'>No events found!</p>";
    }
    ?>
  </div>
</div>

<style>
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}
</style>
<?php include('chatbot-demo.php'); ?>
</body>
</html>
