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
$namaBelakang = explode(" ",$Name)[1]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="about.css">
    <title>Personal Page</title>
    <?php if($namaBelakang === "Kenzhi"): ?>
        <style>
            .img {
                background: url("assets/kenzhi.jpg");
                width: 300px;
                height: 300px;
                background-position: -10;
                display: inline-block;
                background-size: cover;
                background-position: center;
                position: relative;
                bottom: -16px;
            }
        </style>
    <?php else: ?>
        <style>
            .img {
                background: url("assets/errent.jpg");
                width: 300px;
                height: 300px;
                background-position: -10;
                display: inline-block;
                background-size: cover;
                background-position: center;
                position: relative;
                bottom: -16px;
            }
        </style>
    <?php endif; ?>
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
                    <li class="nav-item"><a href="#" class="nav-link active">About</a></li>
                    <li class="nav-item"><a href="../contact/contact.php" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="?logout=true" class="nav-link">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Main -->
    <main class="main">
        <section class="about">
            <div class="about-container">
                <div class="title">
                    <h1>About me</h1>
                    <hr>
                    <p>who i am?</p>
                </div>

                <div class="description">
                    <div class="img"></div>
                    <div class="paragraph">
                        <p class="sub">I'm <?= $namaBelakang?> and i'm a <span>
                            <?php if($namaBelakang == "Errent"): ?>
                                <?= "Gay";?>
                            <?php else: ?>
                                <?= "Smiling Killer"?>
                            <?php endif; ?>
                        </span></p>
                        <p>
                            My name is <?= $namaBelakang?>,
                            <?php if($namaBelakang == "Errent"): ?>
                                <?= "i've been gay since i was 10 years old, i really like playing basketball, i used to be a team star in basketball, but it all changed when i became gay, my friends often mocked me because I'm gay, but even so I really love my friends, I also really like painting and wondering one day I will become a great artist like Salvador Dali, and I'm very good at playing pubg, my friends call me Ato The Last Gyrobender because I can control a delayed gyroscope";?>
                            <?php else: ?>
                                <?= "I've been a smiling killer since 2nd grade of primary school, at that time I accidentally put poison into my friend's food. but I don't regret doing that instead I'm happy and smiling like the picture above. I really admire joker and wish I could be like him one day. because when I smile, it means bad things already happened and will happen again."?>
                            <?php endif; ?>
                        </p>
                        <a href="../contact/contact.php" class="home-button">Contact me</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>