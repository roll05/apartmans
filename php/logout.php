<?php

session_start();
if(isset($_SESSION['korisnik'])){
    unset($_SESSION['korisnik']);
    session_destroy();
    header("Location: ../index.php");
}
else{
    header("Location: ../php/404.php");
}