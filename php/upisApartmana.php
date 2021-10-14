<?php
include ("konekcija.php");

if(isset($_POST['btnUpis'])){
    $nazivApartmana=$_POST['nazivApartmana'];
    $opis=$_POST['opisApartmana'];
    $lokacija=$_POST['lokacija'];
    $cena = $_POST['ddlCenaApartman'];
    $avatar=$_FILES['avatar'];
    $ime=$avatar['name'];
    $tip=$avatar['type'];
    $velicina=$avatar['size'];
    $tmpPutanja=$avatar['tmp_name'];
     $errors=[];
      


     if($ime == ""){
        array_push($errors,"Mora da bude uneta avatar slika!");
	 }

     if(empty($nazivApartmana)){
        array_push($errors,"Naziv apartmana polje mora biti popunjeno");
    }
    if(empty($cena)){
        array_push($errors,"Mora biti zabrana cena!");
    }
    if(!$velicina>3000000){
            array_push($errors, "Fajl mora biti manje od 3MB");
        }
    if(empty($opis)){
        array_push($errors,"Opis mora biti popunjeno");
    }
    if(empty($lokacija)){
        array_push($errors,"Lokacija mora biti uneta");
        }
    if(count($errors)==0){
        
           
            $naziv = time() . $ime;
            $novaPutanja = "../img/" . $naziv;
            $pravaPutanja = "img/" .$naziv;
           
        if (move_uploaded_file($tmpPutanja, $novaPutanja)) {
            $upit1="SELECT `apartmanid` FROM `apartman` ORDER BY `apartmanid` DESC LIMIT 0,1";
              $rez1=$konekcija->prepare($upit1);
              $rez1->execute();
               $apartman=$rez1->fetch();
               $lastIndex = $apartman->apartmanid;
               $newIndex = $lastIndex+1;
        echo $newIndex;
        echo $nazivApartmana;
        echo $opis;
        echo $lokacija;
        echo $cena;
        echo $pravaPutanja;
        echo $ime;
        $upit="INSERT INTO `apartman`(`apartmanid`, `naziv`, `opis`, `lokacija`, `cenaid`, `urlSlike`, `altSlike`) VALUES (29, '$nazivApartmana', '$opis', '$lokacija', $cena, '$pravaPutanja', '$ime')";
        $rez=$konekcija->prepare($upit);
        $rez->execute();
        if($rez){
            header("Location: ../index.php");
        }
        }
        else {
            $status=500;
        }
     }else {
        
        for($i = 0; $i < count($errors); $i++){
            echo $errors[$i];   
            }

     }


    
        
    }else{
    header("Location: ../php/404.php");
}



