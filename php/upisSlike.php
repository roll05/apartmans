<?php session_start();
include "konekcija.php";
if(isset($_POST['btnUpisSlike'])) {
         
        $brSlika = count($_FILES['fSlika']['tmp_name']);
         
        if($brSlika > 1) {
            
           for($i = 0; $i < $brSlika; $i++){
                                 $alt = $_POST['alt'];
                                 $apartman=$_POST['ddlSlikaApartman'];
                                 $slika=$_FILES['fSlika'];
                                 $ime=$slika['name'][$i];
                                 $tip=$slika['type'][$i];
                                 $velicina=$slika['size'][$i];
                                 $tmpPutanja=$slika['tmp_name'][$i];
                                 
                               
                              

                                $errors=[];

                                if($apartman=="0"){
                                    array_push($errors,"Polje mora biti Izabrano");
                                }
                                if(empty($alt)){
                                    array_push($errors,"Polje mora biti popunjeno");
                                }

        
                                if(!$velicina>3000000){
                                    array_push($errors, "Fajl mora biti manje od 3MB");
                                }

                    if(count($errors)==0) {
                                $naziv = time() .$i . $ime;
                                
                                $novaPutanja = "../img/" . $naziv;
                                $pravaPutanja = "img/" .$naziv;

                             if (move_uploaded_file($tmpPutanja, $novaPutanja)) {
                              $upit1="SELECT `slikaid` FROM `slike` ORDER BY `slikaid` DESC LIMIT 0,1";
                              $rez1=$konekcija->prepare($upit1);
                              $rez1->execute();
                              $slika=$rez1->fetch();
                              $lastIndex = $slika->slikaid;
                              $newIndex = $lastIndex+1;
                               $upit = "INSERT INTO `slike`(`slikaid`, `url`, `nameSlike`, `alt`, `apartmanid`) VALUES ($newIndex, '$pravaPutanja', '$naziv', '$alt', $apartman )";
                                    $rez = $konekcija->prepare($upit);
                        try {
                             $rez->execute();
                    
                        } catch (PDOException $e) {
                                        echo $e->getMessage();
                        }
             }
                }
                header("Location: ../index.php");
               }
             }else{     
                     $alt = $_POST['alt'];
                     $apartman=$_POST['ddlSlikaApartman'];
                     $slika=$_FILES['fSlika'];
                     $ime=$slika['name'][0];
                     $tip=$slika['type'][0];
                     $velicina=$slika['size'][0];
                     $tmpPutanja=$slika['tmp_name'][0];
                    
                  
    
        $errors=[];

        if($apartman=="0"){
            array_push($errors,"Polje mora biti Izabrano");
        }
        if(empty($alt)){
            array_push($errors,"Polje mora biti popunjeno");
        }

        
        if(!$velicina>3000000){
            array_push($errors, "Fajl mora biti manje od 3MB");
        }

        if(count($errors)==0) {
            $naziv = time() . $ime;
            $novaPutanja = "../img/" . $naziv;
            $pravaPutanja = "img/" .$naziv;

            if (move_uploaded_file($tmpPutanja, $novaPutanja)) {
                 $upit1="SELECT `slikaid` FROM `slike` ORDER BY `slikaid` DESC LIMIT 0,1";
                              $rez1=$konekcija->prepare($upit1);
                              $rez1->execute();
                              $slika=$rez1->fetch();
                              $lastIndex = $slika->slikaid;
                              $newIndex = $lastIndex+1;
                             $upit = "INSERT INTO `slike`(`slikaid`, `url`, `nameSlike`, `alt`, `apartmanid`) VALUES ($newIndex, '$pravaPutanja', '$naziv', '$alt', $apartman )";
                            $rez = $konekcija->prepare($upit);
                try {
                    $rez->execute();
                     header("Location: ../index.php");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                 }
                }
         
		 }
        
}
}else {
     header("Location: ../php/404.php");
}