<?php
$_SESSION = [];
session_unset();
session_destroy();
header("Location: ../login/login.php");
setcookie("XUSER_C","",time() - 3600);
setcookie("N_USER_","",time() - 3600);
die();
?>