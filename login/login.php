<?php
require "../functions.php";
// kalo udh login gabisa ke login lagi
if(isset($_SESSION["login"])){
    header("Location: ../index.php");
}
// cek ada cookie ga (kalo ada dan valid langsung login) (tidak dipakai)
if(isset($_COOKIE["XUSER_C"]) && isset($_COOKIE["N_USER_"])){
    $id = $_COOKIE["XUSER_C"];
    $result = mysqli_query($conn,"SELECT username FROM users WHERE id=$id");
    $username = mysqli_fetch_assoc($result)["username"];
    if($_COOKIE["N_USER_"] === hash('sha256',$username)){
        $_SESSION["login"] = true;
    }
}
if(isset($_SESSION["login"])){
    header("Location: ../index.php");
}
// kalau bisa login masuk ke halaman utama
if(isset($_POST["login"])){
    if(login($_POST)){
        header("Location: ../index.php");
        exit;
    }
    $logError = true;
}
// kalau daftar
if(isset($_POST["daftar"])){
    if(registrasi($_POST) > 0){
        echo "<script>
                alert('User berhasil dibuat!!')
              </script>";
    }
    else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/12A_Dave.css">
    <script src="js/jquery.js"></script>
    <script src="js/12A_Dave.js"></script>
</head>
<body>
    <div class="container">
        <div class="login">
            <h1 class="tulisan_login">Login</h1>
            <?php if(isset($logError)): ?>
                <p class="errLogin">username/password salah!!!</p>
            <?php endif; ?>
            <form method="post" action="">
                <input type="text" name="userlog" id="username" placeholder="Username or email" autocomplete="off" autofocus>
                <input type="password" name="passlog" id="password" placeholder="Password" autocomplete="off" autofocus>
                <p style="text-align: center;" class="link log"><a href="#">Buat akun</a></p>
                <button name="login" type="submit">Login</button>
            </form>
        </div>
        <div class="sign-up hidden">
            <h1 class="tulisan_login">Sign-up</h1>
            <form method="post" action="">
                <input type="username" id="username" name="userreg" class="user1" placeholder="Username" autocomplete="off" autofocus>
                <input type="password" id="password" name="passreg" class="pass1" placeholder="Password" autocomplete="off" autofocus>
                <input type="password" id="password" name="confpassreg" class="pass1" placeholder="Konfirmasi Password" autocomplete="off" autofocus>
                <input type="umur" id="umur" placeholder="Nama Lengkap" autocomplete="off" autofocus name="name">
                <p style="text-align: center;" class="link up"><a href="#">Sudah punya akun?</a></p>
                <button type="submit" name="daftar">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>