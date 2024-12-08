<?php
session_start();
include("koneksi.php");
include("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Query untuk mendapatkan id_donatur, hashed password, dan status verifikasi
        $stmt = $con->prepare("SELECT id_donatur, Password, is_verified FROM donatur WHERE Email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id_donatur, $hashedPassword, $is_verified);
                $stmt->fetch();

                // Periksa status verifikasi
                if ($is_verified == 0) {
                    $error = "Your account is not verified. Please check your email for the verification code.";
                } else {
                    // Verifikasi password
                    if (password_verify($password, $hashedPassword)) {
                        // Password benar, simpan session
                        $_SESSION['id_donatur'] = $id_donatur;
                        header("Location: index.php");
                        exit();
                    } else {
                        $error = "Invalid password. Please try again.";
                    }
                }
            } else {
                $error = "User not found. Please try again.";
            }
        } else {
            $error = "Database query failed: " . $con->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasih Cinta</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h1>Welcome Back</h1>
            <p>Please log in to your account</p>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Log In</button>
                </div>
                <p class="forgot-password"><a href="#">Forgot your password?</a></p>
            </form>
            <div class="signup-link">
                <p>Don't have an account? <a href="registrasi.php">Sign up now</a></p>
            </div>
        </div>
    </div>
</body>

</html>