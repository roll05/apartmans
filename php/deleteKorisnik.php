<?php
$statusCode=404;
include ("konekcija.php");
if($_SERVER['REQUEST_METHOD']!="POST"){
    header("Location: ../php/404.php");
}
if(isset($_POST['id'])){
    $id=$_POST['id'];

    echo $id;

    $upit="DELETE FROM korisnik WHERE KorisnikId = :id";
    $rez=$konekcija->prepare($upit);
    $rez->bindParam(":id",$id);
    try{
    $rez->execute();
        if($rez){
            $statusCode=204;
            header("Location: ../index.php");
        }
        else {
            $statusCode=500;
        }
    }
    catch(PDOException $e){
        $statusCode=500;
    }

    http_response_code($statusCode);
}