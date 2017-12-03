<?php
    session_start();

    unset($_SESSION['adminUsername']);
    $_SESSION['adminUsername']=null;
    unset($_SESSION['adminFullName']);
?>