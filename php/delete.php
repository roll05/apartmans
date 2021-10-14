<?php
include ("konekcija.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];

    $nazivSlike =  "SELECT nameSlike FROM slike WHERE apartmanid = $id";
    $upit2=$konekcija->query($nazivSlike)->fetchAll();
	$upit3 = "SELECT urlSlike FROM apartman WHERE apartmanid = $id";
             $r=$konekcija->query($upit3)->fetchAll();
    if(count($upit2) == 0){
         
                if(count($r) == 0){
                  
				
                $upit4 = "DELETE FROM ocena WHERE apartmanid = :id";
                $upit1 = "DELETE FROM slike WHERE apartmanid = :id";
                $upit="DELETE FROM apartman WHERE apartmanid = :id";
				$upit5 = "DELETE FROM datumirezrvacija WHERE apartmanid = :id";
                $rez=$konekcija->prepare($upit);
                $rez3=$konekcija->prepare($upit4);
                $rez1=$konekcija->prepare($upit1);
				$rez5=$konekcija->prepare($upit5);
                $rez->bindParam(":id",$id);
                $rez1->bindParam(":id",$id);
                $rez3->bindParam(":id",$id);
				$rez5->bindParam(":id",$id);
                $rez1->execute();
                $rez->execute();
                $rez3->execute();
				 $rez5->execute();
             if($rez){
                header("Location: ../rezervacija.php");
             }else {
                 header("Location: ../rezervacija.php?deleteerror");
            }
        }

		else{
			foreach($r as $a){
			 $imga = get_object_vars($a);
			$path2 = "../" .$imga['urlSlike'];
			unlink($path2);
			}

					$upit4 = "DELETE FROM ocena WHERE apartmanid = :id";
					$upit1 = "DELETE FROM slike WHERE apartmanid = :id";
					$upit="DELETE FROM apartman WHERE apartmanid = :id";
					$upit5 = "DELETE FROM datumirezrvacija WHERE apartmanid = :id";
					$rez=$konekcija->prepare($upit);
					$rez3=$konekcija->prepare($upit4);
					$rez5=$konekcija->prepare($upit5);
					$rez1=$konekcija->prepare($upit1);
					 $rez->bindParam(":id",$id);
					$rez1->bindParam(":id",$id);
					$rez3->bindParam(":id",$id);
					$rez5->bindParam(":id",$id);
					$rez1->execute();
					$rez->execute();
					$rez3->execute();
					 $rez5->execute();
		
           
			   if($rez){
					header("Location: ../rezervacija.php");
				 }else {
					 header("Location: ../rezervacija.php?deleteerror");
				}
		   }

   }else{
	    if(count($r) == 0){
			
				
				foreach($upit2 as $ime){
				$image = get_object_vars($ime);
				$path = "../img/" . $image['nameSlike'];
				unlink($path);
                }
        
    
                $upit4 = "DELETE FROM ocena WHERE apartmanid = :id";
                $upit1 = "DELETE FROM slike WHERE apartmanid = :id";
                $upit="DELETE FROM apartman WHERE apartmanid = :id";
				$upit5 = "DELETE FROM datumirezrvacija WHERE apartmanid = :id";
                $rez=$konekcija->prepare($upit);
                $rez3=$konekcija->prepare($upit4);
                $rez1=$konekcija->prepare($upit1);
				$rez5=$konekcija->prepare($upit5);
				 $rez->bindParam(":id",$id);
                $rez1->bindParam(":id",$id);
                $rez3->bindParam(":id",$id);
				$rez5->bindParam(":id",$id);
                $rez1->execute();
                $rez->execute();
                $rez3->execute();
				 $rez5->execute();
    
             if($rez){
                header("Location: ../rezervacija.php");
             }else {
                 header("Location: ../rezervacija.php?deleteerror");
            }
        }

		else{
			foreach($upit2 as $ime){
				$image = get_object_vars($ime);
				$path = "../img/" . $image['nameSlike'];
				unlink($path);
                }
			
			foreach($r as $a){
			 $imga = get_object_vars($a);
			$path2 = "../" .$imga['urlSlike'];
			unlink($path2);
			}

			$upit4 = "DELETE FROM ocena WHERE apartmanid = :id";
					$upit1 = "DELETE FROM slike WHERE apartmanid = :id";
					$upit="DELETE FROM apartman WHERE apartmanid = :id";
					$upit5 = "DELETE FROM datumirezrvacija WHERE apartmanid = :id";
					$rez=$konekcija->prepare($upit);
					$rez3=$konekcija->prepare($upit4);
					$rez5=$konekcija->prepare($upit5);
					$rez1=$konekcija->prepare($upit1);
					 $rez->bindParam(":id",$id);
					$rez1->bindParam(":id",$id);
					$rez3->bindParam(":id",$id);
					$rez5->bindParam(":id",$id);
					$rez1->execute();
					$rez->execute();
					$rez3->execute();
					 $rez5->execute();
		
           
			   if($rez){
					header("Location: ../rezervacija.php");
				 }else {
					 header("Location: ../rezervacija.php?deleteerror");
				}
		   }

   }
   
}

        
