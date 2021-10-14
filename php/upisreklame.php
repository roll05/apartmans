 <?php
 include "konekcija.php";
 if(isset($_POST['upload'])){
    


         $ime=$_FILES['image']['name'];
         $tmp = $_FILES['image']['tmp_name'];
         $name = $_POST['name'];
         $lokacija = $_POST['lokacija'];
         $brTelefona =$_POST['brtelefona'];

            $naziv = time() . $ime;
            $novaPutanja = "../images/" . $naziv;
            $pravaPutanja = "images/" .$naziv;

            if (move_uploaded_file($tmp, $novaPutanja)) {
                $upit1="SELECT `reklamaid` FROM `reklame` ORDER BY `reklamaid` DESC LIMIT 0,1";        
            $rez1=$konekcija->prepare($upit1);
              $rez1->execute();
               $reklama=$rez1->fetch();
             
               $lastIndex = $reklama->reklamaid;
               $newIndex = $lastIndex+1;


                $upit = "INSERT INTO reklame values (:newIndex, :urlReklame, :altReklame, :ime, :lokacija, :brtelefona)";
                $rez = $konekcija->prepare($upit);
                $rez->bindParam(':newIndex', $newIndex);
                $rez->bindParam(':urlReklame', $pravaPutanja);
                 $rez->bindParam(':altReklame', $ime);
                 $rez->bindParam(':ime', $name);
                 $rez->bindParam(':lokacija', $lokacija);
                 $rez->bindParam(':brtelefona', $brTelefona);
                

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
 