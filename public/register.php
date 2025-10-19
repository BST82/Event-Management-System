<?php
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name','$email','$password','$role')";
    if ($conn->query($sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
  <h3 class="text-center text-success mb-4">Register</h3>
  <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width:400px;">
    <input type="text" name="name" placeholder="Full Name" class="form-control mb-3" required>
    <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
    <select name="role" class="form-control mb-3">
        <option value="attendee">Attendee</option>
        <option value="organizer">Organizer</option>
    </select>
    <button type="submit" class="btn btn-success w-100">Register</button>
    <p class="mt-2 text-center">Already have an account? <a href="login.php">Login</a></p>
  </form>
</div>
</body>
</html>
