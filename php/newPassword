<?php
include("konekcija.php");
if(isset($_POST["dugme"])){
    $email=$_POST['email'];

    $upit = "SELECT * FROM korisnik WHERE email = '$email'";
    $rez=$konekcija->query($upit)->fetch();
    $vkey = md5(time().$email);
   
    $upit1 = "UPDATE `korisnik` SET `vkey`= '$vkey' WHERE email = '$email'";
    $rez1=$konekcija->prepare($upit1);
	$rez1->execute();
    
    if($rez1){

    $to = $email;
    $subject = "Email Verifikacija";
    $mesage= "http://localhost/apartmans/php/verifikacijaPassword.php?vkey=$vkey Kliknte na link da bi verifikovao accounts";
    $headers = "FROM: <sluxzlatibor@gmail.com> \r\n";
    $headers .= "Content-type: text/html; charset=UTF-8";
      if(mail($to, $subject, $mesage, $headers)){
         $status=200; 
    
        }else {
                    $status=500;
                }
           
    header("Location: http://localhost/apartmans/index.php");

}
}else{
    header("Location: ../php/404.php");
}
?>
