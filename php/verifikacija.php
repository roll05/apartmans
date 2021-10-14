<?php 
if(isset($_GET['vkey'])){
	include("konekcija.php");
	$vkey = $_GET["vkey"];
	 $upit="SELECT vkey, verification FROM korisnik WHERE verification = 0 AND vkey = :vkey LIMIT 1";
	 $rez=$konekcija->prepare($upit);
	 $rez->bindParam(":vkey",$vkey);
	$rez->execute();
     if($rez->rowCount()==1){
		$upit1="UPDATE `korisnik` SET `verification`= 1 WHERE vkey = :vkey LIMIT 1";
		 $rez1=$konekcija->prepare($upit1);
		 $rez1->bindParam(":vkey",$vkey);
			$rez1->execute();
				if($rez){
                        header("Location: ../rezervacija.php");
						}
                        else{
                           echo "Nesto nije u redu sa serverom probajte kasnije. <a href='http://localhost/apartmans/index.php'>Vrati se nazad</a>";
						}


	 }else{
	 	 echo "Ovaj account je vec Validiran <a href='http://localhost/apartmans/index.php'>Vrati se nazad</a>";
	 }

}else{
	header("Location: ../php/404.php");
}

?>