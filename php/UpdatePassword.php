<?php 
include ("konekcija.php");
if(isset($_POST['btnReg'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $md5password = md5($password);
    $upit = "UPDATE `korisnik` SET `password`= '$md5password' WHERE email = '$email'";
	$rez=$konekcija->prepare($upit);
	$rez->execute();

}else{
    header("Location: ../php/404.php");
}