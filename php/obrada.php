<?php
include ("konekcija.php");

    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $email=$_POST['email'];
    $brTelefona=$_POST['brtelefona'];
    $password=$_POST['password'];
     $vkey = md5(time().$email);
    $errors=[];

    $reIme="/^[A-ZĐŠŽĆČ][a-zđšžćč]{2,14}(\s[A-ZĐŠŽĆČ][a-zđšžćč]{2,14})?$/";
    $rePrezime="/^[A-ZĐŠŽĆČ][a-zđšžćč]{2,14}(\s[A-ZĐŠŽĆČ][a-zđšžćč]{2,14})?$/";
    $reBroj="/^[0-9]+$/";
    $rePassword="/^[A-z0-9]{8,}$/";

    if(!preg_match($reIme, $ime)){
        array_push($errors,"Ime nije uneto u dobrom formatu");
    }
    if(!preg_match($rePrezime,$prezime)){
        array_push($errors,"Prezime nije uneto u dobrom formatu");
    }
    if(!preg_match($reBroj,$brTelefona)){
        array_push($errors,"Korisnicko ime nije uneto u dobrom formatu");
    }
    if(!preg_match($rePassword,$password)){
        array_push($errors,"Sifra nije uneta u dobrom formatu");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email nije unet u dobrom formatu");
    }

    if(count($errors)!=0){
        var_dump($errors);
        //stilizuj da nesto nije dobro uneto
    }
    else {

        
             $upit="SELECT * FROM korisnik WHERE email=:email";
                $rez=$konekcija->prepare($upit);
                 $rez->bindParam(":email", $email);
                $rez->execute();
                 if($rez->rowCount()==0){
                $md5password=md5($password);
                $upit1="SELECT `KorisnikId` FROM `korisnik` ORDER BY `KorisnikId` DESC LIMIT 0,1";
              $rez1=$konekcija->prepare($upit1);
              $rez1->execute();
               $korisnik=$rez1->fetch();
             
               $lastIndex = $korisnik->KorisnikId;
               $newIndex = $lastIndex+1;
               
                $upit2="INSERT INTO `korisnik`(`KorisnikId`, `ime`, `prezime`, `brojTelefona`, `password`, `email`, `vkey`, `verification`, `ulogaId`) VALUES ($newIndex, '$ime', '$prezime', '$brTelefona', '$md5password', '$email','$vkey', 1, 2)";
                $rez2=$konekcija->prepare($upit2);
                $rez2->execute();

                if($rez2){
                    $fullName = "$ime$prezime";
                   
                    $fromFullName = "SluxZlatibor";
                    $from_email = "sluxzlatibor@gmail.com";
                    $subject = "Email Verifikacija";
                    $mesage= "http://apartmants.epizy.com/php/verifikacija.php?vkey=$vkey Kliknte na link da bi verifikovao accounts";
                    $headers  = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-type: text/html; charset=utf-8\r\n";
                    $headers .= "To: $fullName <$email>\r\n";
                    $headers .= "From: $fromFullName <$from_email>\r\n";
                   if (!mail($email, $subject, $mesage, $headers)){
                      $status=502;
                     
                   }    
                   else{
                       $status=200;
                       
                   }
            
                }
                else {
                    $status=500;
                }
                     
            }else{
                    echo "Vec postoji korisnik sa ovim email-om.";
       
			}
		
            
    }   
