<?php
// Koneksi ke database
session_start();
include("koneksi.php");
include("functions.php");
$user_data = check_login($con);

// Cek koneksi
if ($con->connect_error) {
    die("Koneksi gagal: " . $con->conect_error);
}

// Get the donation ID from the URL parameter
$donationId = $_GET['id_donee'];

// Query to fetch the specific donation
$sql = "SELECT * FROM donee WHERE Id_Donee = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $donationId);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Detail</title>
    <link rel="stylesheet" href="assets/css/donations.css">
</head>

<body>
    <div class="hero">
        <a href="index.php" class="back-link">← Back</a>
        <h1>Donation Detail</h1>
    </div>

    <section class="donation-details">
        <?php if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); ?>
            <div class="donation-card">
                <h3 class="card-title"><?php echo $row['nama']; ?></h3>
                <p class="card-description"><?php echo $row['deskripsi']; ?></p>
                <img src="assets/img/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama']; ?>" class="card-image">
            </div>
        <?php } else { ?>
            <p>Donation not found.</p>
        <?php } ?>
    </section>

    <?php
    $con->close();
    ?>
</body>

</html>