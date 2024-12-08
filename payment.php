<?php
// Mulai session dan koneksi database
session_start();
include("koneksi.php");

// Jika form pembayaran disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $user_id = $_SESSION['id_donatur']; // Ambil ID user dari session

    // Simpan transaksi ke database
    $stmt = $con->prepare("INSERT INTO pembayaran (id_donatur, metode_pembayaran, jumlah, status) VALUES (?, ?, ?, 'pending')");
    $stmt->bind_param("isd", $user_id, $payment_method, $amount);
    $stmt->execute();
    $order_id = $stmt->insert_id; // Ambil ID transaksi
    $stmt->close();

    // Kirim permintaan ke gateway pembayaran (contoh menggunakan Midtrans)
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/charge",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic " . base64_encode("SERVER_KEY:")
        ),
        CURLOPT_POSTFIELDS => json_encode(array(
            "payment_type" => $payment_method,
            "transaction_details" => array(
                "order_id" => $order_id,
                "gross_amount" => $amount
            )
        ))
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    // Decode response dari gateway pembayaran
    $response_data = json_decode($response, true);

    // Redirect ke halaman status pembayaran
    header("Location: ?order_id=$order_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="assets/css/payment.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="payment-container">
        <h1>Payment</h1>

        <?php if (!isset($_GET['order_id'])): ?>
            <!-- Formulir pembayaran -->
            <form method="POST">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" required>

                <label for="payment-method">Payment Method:</label>
                <select id="payment-method" name="payment_method" required>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="ewallet">E-Wallet</option>
                </select>

                <button type="submit">Pay Now</button>
            </form>
        <?php else: ?>
            <!-- Status pembayaran -->
            <div class="status-container">
                <h2>Payment Status</h2>
                <p id="status">Checking payment status...</p>
            </div>

            <script>
                $(document).ready(function () {
                    const orderId = "<?php echo $_GET['order_id']; ?>";

                    // Polling untuk mengecek status pembayaran
                    setInterval(function () {
                        $.ajax({
                            url: "check_status.php",
                            type: "GET",
                            data: { order_id: orderId },
                            success: function (data) {
                                $("#status").text(data);

                                // Jika pembayaran sukses, redirect ke halaman sukses
                                if (data === 'success') {
                                    window.location.href = "success.php";
                                }
                            }
                        });
                    }, 3000); // Cek setiap 3 detik
                });
            </script>
        <?php endif; ?>
    </div>
</body>
</html>
