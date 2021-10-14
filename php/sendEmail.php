<?php 
include("konekcija.php");

if(isset($_POST['sendEmail'])){
    $name = $_POST['name'];
	$email = $_POST['email'];
	$tema = $_POST['subject'];
	$sadrzaj = $_POST['sadrzaj'];

  
                    $to = "sluxzlatibor@gmail.com";
                    $subject = $tema;
                    $mesage= $sadrzaj;
                    $headers = "FROM:" . $email ." \r\n";
                    $headers .= "Reply-To: ".$email."\r\n";
                    $headers .= "Content-type: text/html; charset=UTF-8";
                    mail($to, $subject, $mesage, $headers);
                    
                    
                    $status=200;

}
                else {
                    header("Location: ../php/404.php");
                }
           
		           
            