<?php
session_start();

if (isset($_SESSION['auth'])) {
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['message'] = "Bạn đã đăng xuất tài khoản" ;
}
header('Location: index.php');
?>