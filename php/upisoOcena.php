<?php 
include ("konekcija.php");

if (isset($_POST['id'])) {
	
	$id = $_POST["id"];
	$korisnikid = $_POST["korisnikid"];
	$ocena = $_POST["ratedIndex"];
	$ocenaZaUpis = $ocena + 1;
	$upit = "INSERT INTO `ocena`VALUES ('',:ocena,:KorisnikId,:apartmanid)";
	    $rez=$konekcija->prepare($upit);
        $rez->bindParam(":ocena",$ocenaZaUpis);
        $rez->bindParam(":KorisnikId",$korisnikid);
        $rez->bindParam(":apartmanid",$id);
       
        $rez->execute();
        
		if($rez){
			http_response_code(201);
		}else{
			http_response_code(500);
		}
		
        
}
else{
	header("Location: ../php/404.php");
}
?>
	