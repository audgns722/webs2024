<?php
    include "../connect/session.php";

    unset($_SESSION['memberId']);
    unset($_SESSION['youId']);
    unset($_SESSION['youName']);
    
    header("Location: ../main/main.php");
?>