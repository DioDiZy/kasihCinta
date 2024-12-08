<?php
$msg = "";
if (isset($_POST['submit'])) {
    // Database connection
    $db = mysqli_connect("localhost", "root", "", "kasihcinta");
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto']['name'];
    $target = "assets/img/" . basename($_FILES['foto']['name']);

    // Insert data into the "donee" table
    $sql = "INSERT INTO donee (Nama, Alamat, Deskripsi, Foto) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $alamat, $deskripsi, $foto);

    if (mysqli_stmt_execute($stmt)) {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            // Jika berhasil, tampilkan pesan sukses
            echo "Data berhasil ditambahkan!";
        }
    } else {
        // Jika gagal, tampilkan pesan kesalahan yang lebih spesifik
        echo "Terjadi kesalahan: " . mysqli_error($db);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Donasi</title>
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required><br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" required></textarea><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" required></textarea><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto" required><br>

        <input type="submit" name="submit" value="Tambah Donasi">
    </form>
    <p><?php echo $msg; ?></p>
</body>

</html>