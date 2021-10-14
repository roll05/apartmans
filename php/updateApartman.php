<?php
include ("konekcija.php");
if(isset($_POST['updateApartman'])){
    
    
	    $id =$_POST['apartmanid'];
	    $naziv = $_POST['naziv'];
	    $opis = $_POST['opis'];
	    $lokacija=$_POST['lokacija'];
	    $cena = $_POST['cenaid'];
	    $urlSlike = $_POST['urlSlike'];
	    $altSlike = $_POST['altSlike'];
    
	
	
	        if($_FILES['updateAvatar']['tmp_name'] != ""){
	        
		        $slika = $_FILES['updateAvatar'];
	            $nazivSlike = $slika['name'];
	            $tip=$slika['type'];
                $velicina=$slika['size'];
                $tmpPutanja=$slika['tmp_name'];
                $nazivPutanje = time() . $nazivSlike;
                $novaPutanja = "../img/" . $nazivPutanje;
                $pravaPutanja = "img/" .$nazivPutanje;
		    	    if (move_uploaded_file($tmpPutanja, $novaPutanja)) {
                        $upit="UPDATE `apartman` SET `apartmanid`= :apartmanid,`naziv`=:naziv,`opis`=:opis,`lokacija`=:lokacija,`cenaid`=:cenaid,`urlSlike`=:urlSlike,`altSlike`=:altSlike WHERE apartmanid=$id";
                        $rez=$konekcija->prepare($upit);
                        $rez->bindParam(":apartmanid",$id);
                        $rez->bindParam(":naziv",$naziv);
                        $rez->bindParam(":opis",$opis);
                        $rez->bindParam(':cenaid', $cena);
		                $rez->bindParam(':lokacija', $lokacija);
                        $rez->bindParam(':urlSlike', $pravaPutanja);
                        $rez->bindParam(':altSlike', $nazivSlike);
		    
                        $rez->execute();
                        if($rez){
                        header("Location: ../rezervacija.php");
						}
                        else{
                            header("Location: ../index.php");
						}
            
                    }
                }
            
	            else{ 
                        $upit="UPDATE `apartman` SET `apartmanid`= :apartmanid,`naziv`=:naziv,`opis`=:opis,`lokacija`=:lokacija,`cenaid`=:cenaid,`urlSlike`=:urlSlike,`altSlike`=:altSlike WHERE apartmanid=$id";
                        $rez=$konekcija->prepare($upit);
                        $rez->bindParam(":apartmanid",$id);
                        $rez->bindParam(":naziv",$naziv);
                        $rez->bindParam(":opis",$opis);
                        $rez->bindParam(':cenaid', $cena);
		                $rez->bindParam(':lokacija', $lokacija);
                        $rez->bindParam(':urlSlike', $urlSlike);
                        $rez->bindParam(':altSlike', $altSlike);
		                $rez->execute();
            
                if($rez){
                header("Location: ../rezervacija.php");
				}
                else{
                    header("Location: ../index.php");
				}
            
        }

}
else{
    header("Location: 404.php");
}