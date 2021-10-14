<?php
 include "konekcija.php";
 if(isset($_POST['uploadSliku'])){
    
         $ime=$_FILES['images']['name'];
         $tmp = $_FILES['images']['tmp_name'];

            $naziv = time() . $ime;
            $novaPutanja = "../images/" . $naziv;
            $pravaPutanja = "images/" .$naziv;

            if (move_uploaded_file($tmp, $novaPutanja)) {
            $upit1="SELECT `slikeSliderid` FROM `slikezaslider` ORDER BY `slikeSliderid` DESC LIMIT 0,1";
              $rez1=$konekcija->prepare($upit1);
              $rez1->execute();
               $slikezaslider=$rez1->fetch();
               $lastIndex = $slikezaslider->slikeSliderid;
               $newIndex = $lastIndex+1;
     


                $upit = "INSERT INTO slikezaslider values (:id, :url, :alt,:naziv)";
                $rez = $konekcija->prepare($upit);
                $rez->bindParam(':id', $newIndex);
                $rez->bindParam(':url', $pravaPutanja);
                 $rez->bindParam(':alt', $ime);
                 $rez->bindParam(':naziv', $naziv);

                try {
                    $rez->execute();
                     header("Location: ../index.php");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                 }
                }
         

    
 }

 else {
     header("Location: ../php/404.php");
}
 ?>