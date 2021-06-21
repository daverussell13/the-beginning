<?php
require "functions.php";
// cek session login
if(!isset($_SESSION["login"])){
    header("Location: login/login.php");
    exit;
}
// end session login
if(isset($_GET["logout"])){
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login/login.php");
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
    <link rel="stylesheet" href="style.css">
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
                    <li class="nav-item"><a href="#" class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="linked/slideshow/slideshow.php" class="nav-link">Slideshow</a></li>
                    <li class="nav-item"><a href="linked/about/about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="linked/contact/contact.php" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="?logout=true" class="nav-link">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main -->
    <main class="main">
        <section class="home">
            <div class="home-container grid">
                <div class="home-data">
                    <p class="home-paragraph">Hello, my name is</p>
                    <h1 class="home-title"><?= $namaDepan?> <br> <?= $namaBelakang?></h1>
                    <h2 class="home-description">And i'm a <strong>
                        <?php if($namaBelakang == "Kenzhi"): ?>
                            <?= "<br>Smiling Killer"?>
                        <?php else: ?>
                            <?= "Gay"?>
                        <?php endif; ?>
                    </strong> </h2>
                </div>
                <div class="getstarted"><a href="linked/slideshow/slideshow.php" class="home-button">See Slideshow</a></div>
            </div>
        </section>
    </main>
</body>
</html>