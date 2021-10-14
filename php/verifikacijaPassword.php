<?php 
if(isset($_GET['vkey'])){
	include("konekcija.php");
	$vkey = $_GET["vkey"];
	 $upit="SELECT * FROM korisnik WHERE vkey = :vkey LIMIT 1";
	 $rez=$konekcija->prepare($upit);
	 $rez->bindParam(":vkey",$vkey);
	$rez->execute();
    $korisnik = $rez->fetch();
   
var_dump($korisnik);
    $email = $korisnik->email;
     if($rez->rowCount()==1){
           header("Location: ../Changepassword.php?email=$email");
				}
              else{
                echo "Nesto nije u redu sa serverom probajte kasnije. <a href='http://localhost/apartmans/index.php'>Vrati se nazad</a>";
				}

            }else{
	header("Location: ../php/404.php");
}

?>