<?php 
include("konekcija.php");
if(isset($_POST["KorisnikId"])){
	
	$idkorisnika = $_POST["KorisnikId"];
	$ime=$_POST["ime"];
	$Prezime=$_POST["prezime"];
	$brTelefona = $_POST["brojTelefona"];
	$passwod = $_POST["password"];
	$passwod1 =md5($passwod);
	$email = $_POST["email"];
	$verification = $_POST["verification"];
	$ulogaId = $_POST["ulogaId"];

	$upit="UPDATE `korisnik` SET `ime`=:ime,`prezime`=:prezime,`brojTelefona`=:brojTelefona,`password`=:password,`email`=:email,`verification`=:verification,`ulogaId`=:ulogaId WHERE KorisnikId=$idkorisnika";
                        $rez=$konekcija->prepare($upit);
                        $rez->bindParam(":ime",$ime);
                        $rez->bindParam(":prezime",$Prezime);
                        $rez->bindParam(':brojTelefona', $brTelefona);
		                $rez->bindParam(':password', $passwod1);
                        $rez->bindParam(':email', $email);
                        $rez->bindParam(':verification', $verification);
						$rez->bindParam(':ulogaId', $ulogaId);
						 $rez->execute();
                        if($rez){
                        header("Location: ../korisnici.php");
						}
                        else{
                            header("Location: ../index.php");
						}
            
                    


}else{
	    header("Location: 404.php");
}
?>