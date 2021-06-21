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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="slideshow.css">
    <title>Personal Page</title>
    <style>
        embed {
            position: absolute;
            z-index: -1;
        }
    </style>
</head>
<body>
    <audio src="assets/y2mate.com - Ava Max  Sweet but Psycho Lyrics.mp3" autoplay loop></audio>
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
                    <li class="nav-item"><a href="#" class="nav-link active">Slideshow</a></li>
                    <li class="nav-item"><a href="../about/about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="../contact/contact.php" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="?logout=true" class="nav-link">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main -->
    <main class="main">
        <section class="slide">
            <div class="slideshow-container">
                <div class="title">
                    <h1>Slideshow</h1>
                    <hr>
                    <p>She's sweet but psycho</p>
                </div>

                <div class="slideshow">
                    <div class="slideshow-item">
                        <img src="assets/nanno1.jpg" alt="">
                    </div>

                    <div class="slideshow-item">
                        <img src="assets/nanno2.jpg" alt="">
                    </div>

                    <div class="slideshow-item">
                        <img src="assets/nanno3.jpg" alt="">
                    </div>

                    <div class="slideshow-item">
                        <img src="assets/nanno4.jpg" alt="">
                    </div>

                    <div class="slideshow-item">
                        <img src="assets/nanno5.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        const music = document.querySelector("audio");
        music.volume = 0.5;
    </script>
</body>

</html>