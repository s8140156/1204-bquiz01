<?php

session_start();
unset($_SESSION['login']);
header("location:../index.php");
// 因為沒有include db, 所以不能使用to function




?>
