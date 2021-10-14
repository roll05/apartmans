<?php

include ("konekcija.php");
if(isset($_POST['id'])){
    $id=$_POST['id'];
     $upit3 =  "SELECT 'url' FROM `slikezaslider` WHERE `slikeSliderid` = $id";
     $r=$konekcija->query($upit3)->fetchAll();
     foreach($r as $a){
			 $imga = get_object_vars($a);
			$path = "../" .$imga['url'];
           // echo $path;
			unlink($path);}

    $upit = "DELETE FROM `slikezaslider` WHERE  `slikeSliderid` = $id";
     $rez=$konekcija->prepare($upit);
    try{
    $rez->execute();
        if($rez){
            $statusCode=204;
           
        }
        else {
            $statusCode=500;
        }
    }
    catch(PDOException $e){
        $statusCode=500;
    }

    http_response_code($statusCode);
    }else{
     header("Location: ../php/404.php");
 }