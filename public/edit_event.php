<?php include("../config/db.php");

$id = $_GET['id'];
$event = $conn->query("SELECT * FROM events WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $description = $_POST["description"];
  $location = $_POST["location"];
  $date = $_POST["event_date"];

  $sql = "UPDATE events SET title='$title', description='$description', location='$location', event_date='$date' WHERE id=$id";
  if ($conn->query($sql)) {
    header("Location: index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Event</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
  <h3 class="text-center text-warning mb-4">Edit Event</h3>
  <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width:500px;">
    <input type="text" name="title" class="form-control mb-3" value="<?= $event['title'] ?>" required>
    <textarea name="description" class="form-control mb-3" rows="3"><?= $event['description'] ?></textarea>
    <input type="text" name="location" class="form-control mb-3" value="<?= $event['location'] ?>">
    <input type="date" name="event_date" class="form-control mb-3" value="<?= $event['event_date'] ?>">
    <button type="submit" class="btn btn-warning w-100">Update Event</button>
  </form>
</div>
</body>
</html>
