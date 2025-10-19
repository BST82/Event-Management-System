<?php include("../config/db.php"); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $description = $_POST["description"];
  $location = $_POST["location"];
  $date = $_POST["event_date"];

  $sql = "INSERT INTO events (title, description, location, event_date) VALUES ('$title', '$description', '$location', '$date')";
  if ($conn->query($sql)) {
    header("Location: index.php");
  } else {
    echo "Error: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Event</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
  <h3 class="text-center text-success mb-4">Add New Event</h3>
  <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width:500px;">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Location</label>
      <input type="text" name="location" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Event Date</label>
      <input type="date" name="event_date" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Save Event</button>
  </form>
</div>

</body>
</html>
