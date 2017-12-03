<?php
    session_start();

    unset($_SESSION['username']);
    $_SESSION['username']=null;
    unset($_SESSION['userFullName']);
?>