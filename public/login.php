<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            header("Location: index.php");
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No account found with this email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
  <h3 class="text-center text-primary mb-4">Login</h3>
  <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width:400px;">
    <?php if(isset($error)){ echo "<div class='alert alert-danger'>$error</div>"; } ?>
    <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
    <button type="submit" class="btn btn-primary w-100">Login</button>
    <p class="mt-2 text-center">Don't have an account? <a href="register.php">Register</a></p>
  </form>
</div>
</body>
</html>
