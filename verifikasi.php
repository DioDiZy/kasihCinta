<?php
session_start();
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $otp_code = $_POST['otp_code'];

    // Cek OTP di database
    $stmt = $con->prepare("SELECT * FROM donatur WHERE Email = ? AND otp_code = ?");
    $stmt->bind_param("ss", $email, $otp_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update is_verified
        $update_stmt = $con->prepare("UPDATE donatur SET is_verified = 1 WHERE Email = ?");
        $update_stmt->bind_param("s", $email);
        $update_stmt->execute();
        echo "Verifikasi berhasil! Anda sekarang dapat login.";
        header("Location: login.php");
        exit();
    } else {
        echo "Kode OTP salah atau tidak valid.";
    }

    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <link rel="stylesheet" href="assets/css/registrasi.css">
</head>
<body>
    <div class="verify-container">
        <div class="verify-card">
            <h1>Verifikasi Email Anda</h1>
            <form action="verifikasi.php" method="POST">
                <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                <div class="form-group">
                    <label for="otp-code">Kode OTP</label>
                    <input type="text" id="otp-code" name="otp_code" placeholder="Masukkan kode OTP Anda" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Verify</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
