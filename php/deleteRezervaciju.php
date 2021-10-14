<?php 
include ("konekcija.php");
if(isset($_POST["dugme"])){
	
        $id=$_POST["id"];
        $upit = "DELETE FROM rezervacija WHERE rezervacijaid = :id";
         $rez=$konekcija->prepare($upit);
        $rez->bindParam(":id",$id);
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
