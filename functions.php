<?php
function check_login($con)
{
	// Pastikan session tersedia
	if (isset($_SESSION['id_donatur'])) {
		// Sanitasi input
		$id = mysqli_real_escape_string($con, $_SESSION['id_donatur']);
		$query = "SELECT * FROM donatur WHERE id_donatur = '$id' LIMIT 1";

		// Eksekusi query
		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0) {
			// Ambil data pengguna
			return mysqli_fetch_assoc($result);
		}
	}

	// Kembalikan null jika tidak login
	return null;
}
