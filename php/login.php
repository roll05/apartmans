<?php
session_start();
include ("konekcija.php");

    $email=$_POST["email"];
    $password=$_POST["password"];

    $errors=[];

    $rePassword="/^[A-z0-9]{8,}$/";
    if(!preg_match($rePassword,$password)){
        array_push($errors,"Uneti parametri ne postoje");
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Uneti parametri ne postoje");
    }

    if(count($errors) !=0){
        echo"ima greska";
    }
    else {
        
        $upit="SELECT * FROM `korisnik` WHERE email=:email AND password=:password";
        
        $rez=$konekcija->prepare($upit);
        $md5password=md5($password);
        $rez->bindParam(":email", $email);
        $rez->bindParam(":password", $md5password);
 

        if($rez->execute()){     
            $broj = $rez->rowCount();
            if($rez->rowCount()==1){
                $korisnik=$rez->fetch();
                if($korisnik->verification == 1){
                $_SESSION["KorisnikId"]=$korisnik->KorisnikId;
                $idd=$korisnik->KorisnikId;
                $_SESSION["korisnik"]=$korisnik;

                http_response_code(201);

                if($_SESSION['korisnik']->ulogaId==1){
                    header("Location: ../dodajApartman.php");


                }
                else {
                    header("Location: ../index.php");
                }
                }else{
                        
                echo "Niste verifikovali vas account.";    
				}

            }
            else {
                http_response_code(400);
                echo "Ne postoji ulogovani korisnik sa ovim parametrima";

            }
        }
        else {
            http_response_code(400);
            echo "Upit nije ok";
        }
    }

