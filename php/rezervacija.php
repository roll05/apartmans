<?php 

include ("konekcija.php");

if(isset($_POST['dugme'])){
  
    $idApartmana = $_POST["idApartmana"];
	$idKorisnika =  $_POST["idKorisnika"];
    $datumDo = $_POST["datumDo"];
    $datumOd = $_POST["datumOd"];
	$datumRezervacije=date("Y-m-d H:i:s");
    $email = "sluxzlatibor@gmail.com";
    $upit1 = "SELECT * FROM korisnik WHERE KorisnikId = $idKorisnika limit 1";
   $rez1=$konekcija->query($upit1)->fetchAll();
    $apartman = "SELECT * FROM apartman WHERE apartmanid =$idApartmana limit 1";
    $ap=$konekcija->query($apartman)->fetchAll();
   $naziv = "";
    $mail = "";
    $ime = "";
    $prezime = "";
    $brTelefona = "";
    foreach($rez1 as $m){
     $mail = $m->email;
     $ime = $m->ime;
     $prezime = $m -> prezime;
     $brTelefona = $m-> brojTelefona;

	}
    foreach($ap as $na){
     $naziv = $na->naziv;
	}


    $to = $email;
    $subject = "Upit za slobodne dane";
    $mesage = "Da li je $naziv slobodan od $datumOd do $datumDo . Korisnik koji vas je pitao je $ime $prezime sa emailom - $mail i brojem telefona $brTelefona. Na ovom emailu ili preko ovog broja, mozete da mu odgovorite u sto kracem roku Pozdrav pedercine!";
    $headers = "FROM:$mail  \r\n";
    $headers .= "Reply-To: ".$mail."\r\n";
    $headers.= "Content-type: text/html; charset=UTF-8";
   
   
    mail($to, $subject, $mesage, $headers);
    
    $upit5="SELECT `rezervacijaid` FROM `rezervacija` ORDER BY `rezervacijaid` DESC LIMIT 0,1";
              $rez5=$konekcija->prepare($upit5);
              $rez5->execute();
               $rezervacija=$rez5->fetch();
               $lastIndex = $rezervacija->rezervacijaid;
               $newIndex = $lastIndex+1;
  
       
    $upit="INSERT INTO rezervacija VALUES(:newIndex, :apartmanid, :KorisnikId,0, :datumOd, :datumDo,:datumRezervacije)";
        $rez=$konekcija->prepare($upit);
        $rez->bindParam(":newIndex", $newIndex);
        $rez->bindParam(":apartmanid", $idApartmana);
        $rez->bindParam(":KorisnikId", $idKorisnika);
        $rez->bindParam(":datumOd", $datumOd);
        $rez->bindParam(":datumDo", $datumDo);
        $rez->bindParam("datumRezervacije", $datumRezervacije);
        $rez->execute();

        
        if($rez){
            
            $status=204;
        }
        else {
            $status=500;
        }
    
}else{
    header("Location: ../php/404.php");
}