<?php
include 'db.php';
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            header('Location: add_product.php'); // Redirect to admin panel
            exit;
        } else {
            echo "<div class='alert alert-danger'>Incorrect password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Username not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f953c6, #b91d73);
            height: 100vh;
        }
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding: 2rem;
            max-width: 400px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="form-container">
        <h2 class="text-center mb-4">Admin Login</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
            <p class="text-center mt-3"><a href="signup.php" class="text-decoration-none">Don’t have an account? Signup</a></p>
        </form>
    </div>
</body>
</html>
