<?php

include ("konekcija.php");

if(isset($_POST['dugme'])){
	$rezervacijaid = $_POST['id'];
	$aktivan = $_POST['aktivan'];

	
	$upit = "UPDATE `rezervacija` SET `aktivan`= $aktivan WHERE rezervacijaid = $rezervacijaid";
	$rez=$konekcija->prepare($upit);
	$rez->execute();



	 if($aktivan == 1){
	
	$apartmanid = "";
	$datumOd ="";
	$datumDo ="";
	$KorisnikId= "";
	
	$upit2 = "SELECT apartmanid,KorisnikId, datumDo, datumOd FROM rezervacija WHERE rezervacijaid = $rezervacijaid";
	$rez2=$konekcija->query($upit2)->fetchAll();

	foreach($rez2 as $rezervacije){
		$apartmanid = $rezervacije->apartmanid;
		$datumOd = $rezervacije->datumOd;
		$datumDo = $rezervacije->datumDo;
		$KorisnikId = $rezervacije->KorisnikId;
	}
	 $bookings =[];
	 $bookings [] = $datumOd;
                        while($datumOd != $datumDo){
                                $datumOd = date('Y-m-d', strtotime('+1 day', strtotime($datumOd)));
                                $bookings [] = $datumOd;            
								
								}

	for($i= 0; $i < count($bookings); $i++){
	$datum = $bookings[$i];
    $upit5="SELECT `datumiRezrvacijaid` FROM `datumirezrvacija` ORDER BY `datumiRezrvacijaid` DESC LIMIT 0,1";
    $rez5=$konekcija->prepare($upit5);
    $rez5->execute();
    $datumrezervacije=$rez5->fetch();       
    $lastIndex = $datumrezervacije->datumiRezrvacijaid;
    $newIndex = $lastIndex+1;
	
	$upit1="INSERT INTO datumirezrvacija VALUES (:newIndex, :apartmanid, :datum, :KorisnikId, :rezervacijaid)";
	$rez1 = $konekcija->prepare($upit1);
    $rez1->bindParam(':newIndex', $newIndex);
       $rez1->bindParam(':apartmanid', $apartmanid);
       $rez1->bindParam(':datum', $datum);
	   $rez1->bindParam(':KorisnikId', $KorisnikId);
	   $rez1->bindParam(':rezervacijaid', $rezervacijaid);
	  $rez1->execute();

	}
	}elseif($aktivan == 0){
		$upit3 = "DELETE FROM datumirezrvacija WHERE rezervacijaid = $rezervacijaid";
		$rez3 = $konekcija->prepare($upit3);
		$rez3->execute();
	}

}else{
    header("Location: 404.php");
}