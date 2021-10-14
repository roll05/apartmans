<?php
session_start();
include ("konekcija.php");
if(isset($_SESSION['korisnik'])){

if(isset($_POST['btnKomentar'])) {
    $komentar = $_POST['komentar'];
    $id = $_SESSION['KorisnikId'];
    $date = date('Y-m-d H:i:s');
    $apartman = $_POST["apartmanid"];
    $page = $_SERVER['PHP_SELF'];


    if(!empty($komentar)){


        
        $upit1="SELECT `komentarid` FROM `komentar` ORDER BY `komentarid` DESC LIMIT 0,1 ";
              $rez1=$konekcija->prepare($upit1);
              $rez1->execute();
               $komentar1=$rez1->fetch();
               $lastIndex = $komentar1->komentarid;
               $newIndex = $lastIndex+1;
             echo $komentar;
             echo $date;
        $upit="INSERT INTO `komentar`(`komentarid`, `Komentar`, `datum`, `KorisnikId`, `apartmanid`) VALUES ($newIndex, '$komentar', '$date', '$id', $apartman)";
        $rez=$konekcija->prepare($upit);
        $rez->execute();

        if($rez){
            $status=201;
            header("Location: ../apartman.php?id=$apartman");
        }
        else {
            $status=500;
        }
    }
    
}else{
           header("Location: 404.php");
	}
}else{
           header("Location: ../registracija.php");
	}
