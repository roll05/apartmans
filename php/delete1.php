<?php 
include ("konekcija.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $upit1 = "SELECT urlSlike FROM apartman WHERE apartmanid = $id";
    $rez=$konekcija->query($upit1)->fetchAll();

    foreach($rez as $a)
      $imga = get_object_vars($a);
      $path2 = "../" .$imga['urlSlike'];
      var_dump($path2);
     }


     <form>
                            
                        <label>
                            Unesite ocenu</br>
							<i>(ocena izmedju 1 i 5)</i>
                        </label><br />
                        <input type="text" id="glasaj" name="glasaj" placeholder="Tape your assessment " /><br />
                        <label>
                           Kratak komentar zasto ta ocena
                        </label><br />
                        <textarea cols="50" rows="3" name="ocenaOpis" id="ocenaOpis"></textarea><br /><br />
                        <input type="button" id="dugmeGlasaj" name="dugmeGlasaj" value="Glasaj" />
                        </form>
                        </div>
                        <div class="columnOcena"><b></b></div>

                         <script>
    $("#dugmeGlasaj").click(function () {

    
   var id = "<?php echo "$id"?>";
    var korisnikid = "<?php echo"$korisnikid"?>";
    var ocena = $("#glasaj").val();
    var regOcena = /[1-5]/;
    var greske = new Array();
    var podaci = new Array();
    var opis = $("#ocenaOpis").val();
      
      if(opis.length == 0){
      greske.push("Morate uneti kratak opis");
      }
  
    if (regOcena.test(ocena)) {
        podaci.push();
    }
    else {
        greske.push("Morate izabrati dobru ocenu");

    }
   
    if (greske.length > 0) {
        var ispis = "";
        for (var i = 0; i < greske.length; i++) {
            ispis += "" + greske[i] + "</br>";
        }
        $(".columnOcena").html(ispis);
    }
    else {

        $.ajax({

            url: "http://localhost/apartmans/php/upisoOcena.php",
            method: "POST",
            data: {
                opis : opis,
                korisnikid : korisnikid,
                id : id,
                ocena: ocena,
                btnReg: true
            },
            success: function (podaci) {
                  // alert("Poslali ste email.Nadamo se da cemo u sto kracem roku da vam odgovorimo.Hvala na razumevanju.");
                  // location.reload();
                }


            
        });


    }

});

  </script>


  
	$upit = "INSERT INTO `ocena`VALUES ('',:ocena,:KorisnikId,:apartmanid)";
	    $rez=$konekcija->prepare($upit);
        $rez->bindParam(":ocena",$ocena);
        $rez->bindParam(":KorisnikId",$korisnikid);
        $rez->bindParam(":apartmanid",$id);
       
        $rez->execute();
        
		if($rez){
			http_response_code(201);
		}else{
			http_response_code(500);
		}
		
        
}
else{
	header("Location: ../php/404.php");
}
?>


<script>

				$(document).ready(function(){

				$("#sendEmail").click(function(){
				var email = $("#ename");
				var subject = $("#tema");
				var sadrzaj = $("#sadrzaj");
				var name = $("#name");
					

					if (isNotEmpty(subject) && isNotEmpty(sadrzaj)) {
					
						$.ajax({

							url: "http://localhost/apartmans/php/sendEmail.php",
							method: "POST",
							dataType: "json",
							data: {
								name : name.val(),
								email : email.val(),
								subject : subject.val(),
								sadrzaj : sadrzaj.val(),
								sendEmail: true
							},
							success: function (podaci) {
									console.log(podaci);
								 //  alert("Thanks for your vote!");
								  // location.reload();
								}


            
								 });
					
				}
				
				
				});
					function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
				 } else
                caller.css('border', '');

				 return true;
        }
				});


			</script>



             <?php if(isset($_SESSION['korisnik'])):
                         if($_SESSION['korisnik']->ulogaId == 1 ):?>
                         <?php include("php/deleteSlikeZaSlider.php");?>
                    <a href="php/deleteSlikeZaSlider.php?id=<?=$image->slikeSliderid?>"  class="procitajVise delete" name="delete" id="delete">Delete</a>
                    <?php endif ?>
                    <?php endif ?>



                    
	$upit = "INSERT INTO rezervacija VALUES ('', ':apartmanid', ':KorisnikId', ':datum_od', ':datum_do')";
	$rez=$konekcija->prepare($upit);
        $rez->bindParam(":apartmanid", $idApartmana);
        $rez->bindParam(":KorisnikId", $idKorisnika);
        $rez->bindParam(":datum_od", $datumOd);
        $rez->bindParam(":datum_do", $datumDo);
		$rez->execute();
		if($rez){
            $status=204;
        }
        else {
            $status=500;
        }
    }
else{
    header("Location: ../php/404.php");

}
 $datumod = $row["datumOd"];
                $datumdo =$row["datumDo"];
                while($datumod != $datumdo){
                        $bookings []= $datumod;
                        $totimestamp = strtotime($datumod);
                        $totimestampplus24 = $totimestamp+86400;
                        $datumi = date("Y-m-d", $totimestampplus24);
                
					 }
                  
				}
                var_dump($bookings);
                var_dump($row["datumDo"]);
                var_dump($totimestampplus24);

<?php
 // za rezervaciju dugmica 

                $id=$_GET['id'];
    $mysqli = new mysqli('localhost', 'root', '', 'apartmans');
    $stmt = $mysqli->prepare("select * from rezervacija where apartmanid = ? AND MONTH(datumOd) = ? AND YEAR(datumOd) = ?");
    $stmt->bind_param('sss', $id, $month, $year);
    $bookings = array(); 
    
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){ 
                $datumOd = $row["datumOd"];  
                $datumDo = $row["datumDo"];
                
                 if($datumOd != $datumDo ){
                  $bookings [] = $datumOd;
                        while($datumOd != $datumDo){
                                $datumOd = date('Y-m-d', strtotime('+1 day', strtotime($datumOd)));
                                $bookings [] = $datumOd;            
								
								}
 
				 }else{
                        $bookings [] = $datumOd;
				 }

                      
				 }
                  
				}

            
            
            $stmt->close();
        
    }




    if($aktivan == 1){
	
	$apartmanid = "";
	$datumOd ="";
	$datumDo ="";
	$KorisnikId= "";
	
	$upit2 = "SELECT apartmanid,KorisnikId, datumDo, datumOd FROM rezervacija WHERE rezervacijaid = $rezervacijaid";
	$rez2=$konekcija->query($upit2)->fetchAll();

	foreach($rez2 as $rezervacije){
		$apartmanid = $rezervacije->apartmanid;
		$datumOd = $rezervacije->datumOd;
		$datumDo = $rezervacije->datumDo;
		$KorisnikId = $rezervacije->KorisnikId;
	}
	 $bookings =[];
	 $bookings [] = $datumOd;
                        while($datumOd != $datumDo){
                                $datumOd = date('Y-m-d', strtotime('+1 day', strtotime($datumOd)));
                                $bookings [] = $datumOd;            
								
								}

	for($i= 0; $i < count($bookings); $i++){
	$datum = $bookings[$i];
	
	$upit1="INSERT INTO datumiRezrvacija VALUES ('', :apartmanid, :datum, :KorisnikId, :rezervacijaid)";
	$rez1 = $konekcija->prepare($upit1);
       $rez1->bindParam(':apartmanid', $apartmanid);
       $rez1->bindParam(':datum', $datum);
	   $rez1->bindParam(':KorisnikId', $KorisnikId);
	   $rez1->bindParam(':rezervacijaid', $rezervacijaid);
	  $rez1->execute();

	}
	}elseif($aktivan == 0){
		$upit3 = "DELETE FROM datumiRezrvacija WHERE rezervacijaid = $rezervacijaid";
		$rez3 = $konekcija->prepare($upit3);
		$rez3->execute();
	}
	
    ?>