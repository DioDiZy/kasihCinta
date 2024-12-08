<?php
session_start();
include("koneksi.php");
require 'vendor/autoload.php'; // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars(trim($_POST['full_name']));
    $alamat = htmlspecialchars(trim($_POST['address']));
    $username = htmlspecialchars(trim($_POST['username']));
    $telepon = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Generate kode OTP
    $otp_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO donatur (Nama, Alamat, Username, Email, No_Telepon, Password, otp_code, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("sssssss", $nama, $alamat, $username, $email, $telepon, $hashedPassword, $otp_code);

    if ($stmt->execute()) {
        // Kirim email OTP
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gunakan server SMTP sesuai provider
            $mail->SMTPAuth = true;
            $mail->Username = 'fairuzafifherdanto@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'kike zbrj ylhd odpm'; // Ganti dengan password email Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Pengaturan email
            $mail->setFrom('your_email@gmail.com', 'Kasih Cinta');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi Email Anda';
            $mail->Body = "Halo $nama,<br><br>Terima kasih telah mendaftar. Berikut adalah kode OTP Anda: <b>$otp_code</b><br>Masukkan kode ini untuk memverifikasi email Anda.";

            $mail->send();
            echo "Registrasi berhasil! Silakan cek email Anda untuk verifikasi.";
            header("Location: verifikasi.php?email=$email");
            exit();
        } catch (Exception $e) {
            echo "Gagal mengirim email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kasih Cinta</title>
    <link rel="stylesheet" href="assets/css/registrasi.css">
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <h1>Join Us</h1>
            <p>Create your account and start your journey</p>
            <form action="registrasi.php" method="POST">
                <div class="form-group">
                    <label for="full-name">Nama Lengkap</label>
                    <input type="text" id="full-name" name="full_name" placeholder="Masukkan nama lengkap Anda" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea id="address" name="address" placeholder="Masukkan alamat Anda" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="form-group">
                    <label for="phone">No. Telepon</label>
                    <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Buat password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Sign Up</button>
                </div>
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="login.php">Log in</a></p>
            </div>
        </div>
    </div>
</body>

</html>