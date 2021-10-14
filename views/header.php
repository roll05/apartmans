<?php session_start();
include ("php/konekcija.php");?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/jquery.rateyo.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
    <meta charset="utf-8" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="img/icon.ico" />
    <title>S'lux Zlatibor</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
 
    <style>
     .today {
    background-color: beige;
    }
     </style>

</head>
<body>
    <div class="container head">
        <nav class="navbar navbar-default">
            <div class="container links">
            <div class="col-md-6 naviLinks">
                <div class="navbar-header">
                    
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="rezervacija.php">Rezervation</a></li>
                        <li><a href="info.php">Info</a></li>
                    </ul>
                </div>
                </div>
                 <div class="col-md-6 registracija">
                 <ul>
                 <?php if(!isset($_SESSION['korisnik'])):?>
                       
                            <a href="registracija.php">Prijavi se / Registruj se</a>
                        
                        <?php endif; ?>
                        <?php if(isset($_SESSION['korisnik'])):?>
                           
                                <a href="php/logout.php">Odjavi se</a>
                            
                           
                                <?php

                                                $upit = "SELECT ime, prezime FROM korisnik WHERE KorisnikId = :idKorisnik";
                                                $priprema = $konekcija->prepare($upit);

                                                $id = $_SESSION['KorisnikId'];

                                                $priprema->bindParam(':idKorisnik',$id);

                                                $rez = $priprema->execute();

                                                if($rez){
                                                $korisnik = $priprema->fetch();
                                                echo $korisnik->ime. " " . $korisnik->prezime;
                                    }
                                                ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                 </div>

            </div>
            <div class="container title">
                <h1>Dobro dosli na S'lux Zlatibor </h1>
            </div>
        </nav>
    </div>
    <div class="video-container">
                <div class="color-overlay"></div>
                <video autoplay loop muted>
                    <?php 
                    $godDoba = "";
                    $datum = date("m-d");
                    if($datum < "04-21" || $datum > "10-22"){
                        $godDoba = "Zima";         
					}
                    else{
                        $godDoba = "Leto";
					}
                     
                    
                    $upit1 = "SELECT * FROM video WHERE opis='$godDoba'";
                    $rez1=$konekcija->query($upit1)->fetchAll();
                    foreach($rez1 as $r ):?>

                    <source src="<?=$r->urlVideo;?>" type="video/mp4">
                    <?php endforeach;?>
                </video>
    </div>
     