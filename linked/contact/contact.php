<?php
require "../../functions.php";
// cek session login
if(!isset($_SESSION["login"])){
    header("Location: ../../login/login.php");
    exit;
}
// end session login
if(isset($_GET["logout"])){
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: ../../login/login.php");
    setcookie("XUSER_C","",time() - 3600);
    setcookie("N_USER_","",time() - 3600);
}
$Name = ucwords($_SESSION["name"]);
$namaDepan = explode(" ",$Name)[0];
$namaBelakang = explode(" ",$Name)[1];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="contact.css">
    <title>Personal Page</title>
</head>

<body>

    <!-- Header -->
    <header class="header">
        <nav class="nav grid">
            <div>
                <a href="#" class="nav-logo">My Website</a>
            </div>

            <input type="checkbox" id="check">
            <label class="nav-toggle" for="check">
                <i class='bx bx-menu'></i>
            </label>

            <div class="nav-menu">
                <label class="nav-close" for="check">
                    <i class='bx bx-x'></i>
                </label>

                <ul class="nav-list">
                    <li class="nav-item"><a href="../../index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="../slideshow/slideshow.php" class="nav-link">Slideshow</a></li>
                    <li class="nav-item"><a href="../about/about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link active">Contact</a></li>
                    <li class="nav-item"><a href="?logout=true" class="nav-link">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main -->
    <main class="main">
        <section class="contact">
            <div class="contact-container">
                <div class="title">
                    <h1>Contact me</h1>
                    <hr>
                    <p>get in touch</p>
                </div>

                <div class="sosmed">
                    <?php
                        if($namaBelakang === "Kenzhi") $linkIg = "geraldo_kenzhi/";
                        else $linkIg = "errent_1809/";
                    ?>
                    <a class="box" href="https://instagram.com/<?=$linkIg;?>" target="_blank">
                        <div class="ig"></div>
                        <p>Instagram</p>
                    </a>
                    <a class="box" href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=GTvVlcSMVkjMRBlwZTPtwrdwSmPkxtvchdjvjdHzjScTbCsvkNBLdWhSrLNcPtsJrQzKpXTKkCDGZ" target="_blank">
                        <div class="email"></div>
                        <p>Email</p>
                    </a>
                    <?php
                        if($namaBelakang === "Kenzhi") $linkFb = "profile.php?id=100010466551979";
                        else $linkFb = "alexander.errent";
                    ?>
                    <a class="box" href="https://www.facebook.com/<?= $linkFb;?>" target="_blank">
                        <div class="fb"></div>
                        <p>Facebook</p>
                    </a>
                </div>

            </div>
        </section>
    </main>
</body>
</html>