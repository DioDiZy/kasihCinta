<?php
session_start();
include("koneksi.php");
include("functions.php");
$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasih Cinta</title>
    <link rel="stylesheet" href="assets/css/berandax.css">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">KASIH CINTA</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#donate">Donate</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li>
                    <?php if ($user_data): ?>
                        <a href="logout.php" class="btn-logout">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="register-btn">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        <div class="hero">
            <h1>Let's Make The World <span class="highlight">Better Together</span></h1>
            <p>Every child deserves the opportunity to a better tomorrow. Join us in making a difference through compassionate giving!</p>
            <a href="#donate" class="btn-donate">Donate Now</a>
        </div>
    </header>

    <!--about-->>
    <section id="about" class="about-section">
        <div class="about-content">
            <div class="about-text">
                <h2 class="about-title">About Kasih Cinta</h2>
                <h3 class="about-subtitle">We Are Here For You</h3>
                <p class="about-description">
                    Welcome to Kasih Cinta, where compassion meets action. Our mission is to make meaningful impact on the lives of children in need. With a heart-driven commitment, we strive to create positive change in our communities and beyond. At Kasih Cinta, we believe in the power of collective generosity to address pressing issues, fostering a world where empathy knows no boundaries. Join us on this journey on compassion, as together, we build a brighter future for all the children who do not have the resources and privileges.
                </p>
            </div>
            <div class="about-images">
                <!-- <img src="image1.jpg" alt="Helping Hand" class="image-top"> -->
                <img src="assets/img/About.png" alt="Group Help" class="image-bottom">
            </div>
        </div>
    </section>

    <!-- How to Start Help -->
    <section id="how-to-start" class="how-to-start-section">
        <div class="how-to-start-content">
            <h2 class="how-to-start-title">How To Start Help</h2>
            <p class="how-to-start-description">
                In carrying out their duties, charitable foundations provide a variety of social services such as education, food, medicine, housing, and others.
            </p>
            <div class="how-to-start-steps">
                <div class="step">
                    <div class="icon">
                        <img src="assets/icon/ph_users.png" alt="Register Icon">
                    </div>
                    <h3 class="step-title">Register Yourself</h3>
                    <p class="step-description">Sign up to join and be part of the good people who love to share.</p>
                </div>
                <div class="step">
                    <div class="icon">
                        <img src="assets/icon/ph_hands-clapping.png" alt="Donate Icon">
                    </div>
                    <h3 class="step-title">Select Donate</h3>
                    <p class="step-description">There are many things you can choose to share goodness with.</p>
                </div>
                <div class="step">
                    <div class="icon">
                        <img src="assets/icon/ph_smiley.png" alt="Share Icon">
                    </div>
                    <h3 class="step-title">Share Happiness</h3>
                    <p class="step-description">Sharing happiness with those less and doing more good for others.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section id="services" class="services-section">
        <h2 class="title-highlight">Our Services</h2>
        <p>Every Child Deserves Happiness</p>
        <div class="service-boxes">
            <div class="service-box">
                <h3>Scholarship</h3>
                <p>We engage children in scholarship programs to enable them have strong educational background.</p>
            </div>
            <div class="service-box">
                <h3>Health Care</h3>
                <p>We engage children in programs to ensure their health and well-being.</p>
            </div>
            <div class="service-box">
                <h3>Campaign</h3>
                <p>We engage children in advocacy for their rights and support.</p>
            </div>
            <div class="service-box">
                <h3>Skill Acquisition</h3>
                <p>We teach children valuable skills to help them build a better future.</p>
            </div>
        </div>
    </section>

    <!-- Donation -->
    <section id="donate">
        <div class="container donate-section">
            <h1 class="donate-title">Donate</h1>
            <h2>Your help is Needed</h2>
            <div class="donation-grid">
                <?php
                // Query untuk mengambil semua data dari tabel donee
                $sql = "SELECT Id_Donee, Nama, Alamat, Deskripsi, Foto FROM donee";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    // Jika ada data, tampilkan dalam bentuk card
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='donation-box'>";
                        echo "<img src='./assets/img/" . $row['Foto'] . "' alt='Donation Image'>";
                        echo "<div class='donation-info'>";
                        echo "<h3>" . $row['Nama'] . "</h3>";
                        echo "<p>" . $row['Alamat'] . "</p>";
                        echo "<h4>" . $row['Deskripsi'] . "</h4>"; ?>
                        <?php if ($user_data): ?>
                            <?php
                            echo "<a href='donation.php?id_donee=" . $row['Id_Donee'] . "'><button >Donate</button></a> ";
                            ?>
                        <?php else: ?>
                            <a href="#"><button onclick="alert('Please Login First'); window.location.href = 'login.php';">Donate</button></a>
                        <?php endif; ?>
                <?php
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "Tidak ada data donasi yang ditemukan.";
                }
                ?>
                <div class="donation-box">
                    <img src="assets/img/card-image.png" alt="Donation Image">
                    <div class="donation-info">
                        <h3>$20/MON</h3>
                        <p>Or Make One Time Donation</p>
                        <h4>Share Food With Others In Need</h4>
                        <?php if ($user_data): ?>
                            <a href="#"><button onclick="window.location.href = 'donation.php';">Donate</button></a>
                        <?php else: ?>

                            <a href="#"><button onclick="alert('Please Login First'); window.location.href = 'login.php';">Donate</button></a>
                        <?php endif; ?>

                        <div class="progress-info">
                            <span>Raised: $69,152</span>
                            <span>Goal: $89,000</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress"></div>
                        </div>
                    </div>
                </div>
                <!-- Duplicate the donation-box div for more cards -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="images/logo.png" alt="Logo">
                <p>Our vision is to provide convenience and help increase your sales business.</p>
                <div class="social-icons">
                    <a href="#"><img src="images/facebook-icon.png" alt="Facebook"></a>
                    <a href="#"><img src="images/twitter-icon.png" alt="Twitter"></a>
                    <a href="#"><img src="images/instagram-icon.png" alt="Instagram"></a>
                </div>
            </div>
            <div class="footer-links">
                <div class="footer-section">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">How it works</a></li>
                        <li><a href="#">Featured</a></li>
                        <li><a href="#">Partnership</a></li>
                        <li><a href="#">Business Relation</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Community</h3>
                    <ul>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Podcast</a></li>
                        <li><a href="#">Invite a friend</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Socials</h3>
                    <ul>
                        <li><a href="#">Discord</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>©2022 Company Name. All rights reserved</p>
            <div class="footer-privacy">
                <a href="#">Privacy & Policy</a> | <a href="#">Terms & Condition</a>
            </div>
        </div>
    </footer>
</body>

</html>