<?php
include("views/header.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
   } else{ 
    header("Location: index.php");
    }
   

function build_calendar($month, $year){
   
    $dateComponents= getdate();
     if(isset($_GET['month']) && isset($_GET['year'])){
      $month = $_GET['month'];
      $year = $_GET['year'];
	 }
     else{
     $month = $dateComponents['mon'];
     $year = $dateComponents['year'];
     
	 }
       // $upit7 = "SELECT * FROM datumirezrvacija WHERE apartmanid = $id AND MONTH(datum) = $month AND YEAR(datum) = $year";
      //  $rez7=$konekcija->prepare($upit7);
     //  $rez7->execute();

         $id=$_GET['id'];
    $mysqli = new mysqli('sql103.epizy.com', 'epiz_29876556', 'Phln4yQ9ou', 'epiz_29876556_apartmans');
    $stmt = $mysqli->prepare("SELECT * FROM datumirezrvacija WHERE apartmanid = ? AND MONTH(datum) = ? AND YEAR(datum) = ?");
   $stmt->bind_param('sss', $id, $month, $year);
    $bookings = array(); 
    
    if($stmt->execute()){
       $result = $stmt->get_result();
       if($result->num_rows>0){
          while($row = $result->fetch_assoc()){ 
           $bookings [] =  $bookings[] = $row['datum'];
          }   
            
            $stmt->close();
        }
        }
    
    $id=$_GET['id'];
    $daysOfWeek  = array('Ponedeljak','Utorak','Sreda','Cetvrtak','Petak','Subota','Nedelja');
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
    $numberDays = date('t',$firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    
    if($dayOfWeek == 0){
     $dayOfWeek =6;
	}else{
     $dayOfWeek = $dayOfWeek-1;
	}
   
   
    $dateToday = date('Y-m-d');
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?id=".$id."&month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Prethodni mesec</a> ";
    
    $calendar.= " <a class='btn btn-xs btn-primary' href='?id=".$id."&month=".date('m')."&year=".date('Y')."'>Trenutni Mesec</a> ";
    
    $calendar.= "<a class='btn btn-xs btn-primary' href='?id=".$id."&month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Sledeci mesec</a></center><br>";
    $calendar .= "<tr>";

    foreach($daysOfWeek as $days){
     $calendar.="<th style='width:12%;' class='header'>$days</th>";
	}

    $calendar.="</tr><tr>";
    if($dayOfWeek > 0){
        for($k = 0; $k < $dayOfWeek;$k++){
            
            $calendar.="<td></td>";
		}
    }
    $currentDay =1;
    $month = str_pad($month,2,"0",STR_PAD_LEFT);
    
    while($currentDay<=$numberDays){

    if($dayOfWeek == 7){
        $dayOfWeek = 0;
        $calendar.="</tr><tr>";
	}

     $currentDayRel=str_pad($currentDay,2,"0",STR_PAD_LEFT);
     $date = "$year-$month-$currentDayRel";

     $dayname = strtolower(date('l', strtotime($date)));
     $eventNum = 0;
     $today = $date ==date("Y-m-d")?"today" : "";
      if($date<date('Y-m-d')){
             $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>N/A</button>";
         }
      elseif(in_array($date, $bookings)){$calendar.="<td class='$today'><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>Rezervisano</button>";}
      else{
             $calendar.="<td class='$today'><p hidden>$year-$month-$currentDayRel</p><h4>$currentDay</h4><button class='btn btn-success btn-xs datum' onclick = 'dodajDatum(event.currentTarget.previousSibling.previousSibling.innerText )'>Rezervisi</button>";
         }
            
    
     $calendar .= "</td>";
     
     $currentDay ++;
     $dayOfWeek ++;
	}
    if($dayOfWeek != 7){
     $remainingDays = 7- $dayOfWeek;
     for($i = 0;$i<$remainingDays;$i++){
        $calendar.="<td></td>";
	 }
	}
    $calendar.="</tr>";
    $calendar.="</table>";
    echo $calendar;
    
}

?>



    <div class="container">
    <hr class="hrNaslov"/>
    <div class="row">
    
   

    
<?php 
     $upit = "SELECT * FROM slike WHERE apartmanid = $id";
     $rez=$konekcija->query($upit)->fetchAll();
    
     foreach($rez as $apartmani): 
       
        
     ?>
     
    <div class="col-md-3 galery" style="margin-top:10px;">
    
    <a data-fancybox="gallery" href="<?=$apartmani->url?>"><img src="<?=$apartmani->url?>" alt="<?=$apartmani->alt?>"></a>
    </a>
  </div>
        
               
            
<?php endforeach;?>

    
</div>
</div>
</div>
<div class="container">
    <hr class="hrNaslov"/>
    <div class="row">
    <div class="col-md-6 oApartmanu" id="izdvojeno">

    <?php 
  
     $upit1 = "SELECT * FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid  WHERE apartmanid = $id";
    $rez1=$konekcija->query($upit1)->fetchAll();
   
    foreach ($rez1 as $item):
   
     ?>
           
         <h1 class="naslov"> <?=$item->naziv?> </h1></br>
         <?php
     $upit5 = "SELECT AVG(ocena) AS prosekOcena FROM ocena WHERE apartmanid = $id";
    $rez5=$konekcija->query($upit5)->fetchAll();
    foreach ($rez5 as $ite):
    $vrednost = $ite->prosekOcena;
   ?>
                
                       <div class="rateYo" style="float:left;" ></div></br></br>
                        <script>
                         var vrednost = "<?php echo "$vrednost"?>";
                         if(vrednost == ""){
                                vrednost = 0;              
						 }
                          
                         $(function () {
                                
                                
                             $(".rateYo").rateYo({
                                   rating: vrednost,
                                   readOnly: true
                             

                                });
 
                            });
                        </script>
     
    
                        
       <?php endforeach; ?>
       <div class="oApartmanu" style="float:left;">
       <?php  
             $idCene = $item->cenaid;
             if($idCene == 23){
       ?>

         <h7><b>Cena po noci : <?=$item->vrednost?> </b></h7><br>
           <?php } else{?>
          <p>
          <h7><b>Cena po noci : <?=$item->vrednost?> &euro;</b></h7><br>
          </p>
          
          <?php }?>
          
          <p>
          <?=$item->opis?>
          </p>
          </div>
     <?php endforeach; ?>
     </div>
     </div>
     <div class="col-md-6 oApartmanu" id="izdvojeno">
     
     </div>
    </div>
    <div class="container">
    
    <div class="row">
     <div class="col-md-12 oApartmanu" style="text-align:center;" id="izdvojeno" >
  
     <?php

    
     echo build_calendar($month,$year);
     
     ?>
     <div style="text-align:center;">
     <?php 
     if(isset($_SESSION['korisnik'])){
     
       $korisnikid = $_SESSION['KorisnikId'];
     ?>
     <input type="hidden" value ="<?php echo $id ?>" name ="idApartmana" id ="idApartmana">
     <input type="hidden" value ="<?php echo $korisnikid ?>"; name ="idKorisnika" id ="idKorisnika">
     <input type="button" class="btn btn-xs btn-primary" name="rezervisiDatum" value="Prikazi datume za boravak"  onclick="prikaziDatume()" >
     <?php } else{
     ?>
     <p>Morate biti ulogovani da bi ste rezervisali apartman.To mozete uraditi <a href="registracija.php" style="text-decoration:none; color:black;" class="kontaktMail" >klikom ovde</a></p>
	 <?php } ?>
     </div>
     <div id="ispis">
             
            
     </div>
     <script>
     var numArray = "";
    var realDatum;



    if (localStorage.getItem('datumi') != "") {

    numArray += localStorage.getItem('datumi');

    function dodajDatum(event) {

        
        numArray += "," + event;
        localStorage.setItem('datumi', numArray);

    }

    }
        else {
    function dodajDatum(event) {

         
        numArray += "," + event;
        localStorage.setItem('datumi', numArray);

     }

    }
    var res = numArray.split(",");
    
     function prikaziDatume() {
  
    
    var nizerror = [];

   var  idApartmana = $("#idApartmana").val();
    var   idKorisnika = $("#idKorisnika").val();
        var res = numArray.split(",");
      
    if (res.indexOf("null") == 0) {
        res.shift();
        var uniqueChars = [...new Set(res)];
        realDatum = uniqueChars.sort();
        
    }
 
    if (realDatum.length == 0) {
        nizerror.push("Nema datuma");
        document.getElementById("ispis").innerHTML = "Molim vas izaberite neki datum";

    }

    else {
        

        var datumOd = realDatum[0];
        var datumDo = realDatum.pop();
		
        
      
        
        location.replace("rezervisi.php?idA=" + idApartmana + "&idK=" + idKorisnika + "&datumOd=" + datumOd + "&datumDo=" + datumDo);
       
      
       
    }
    }
   
    </script>
    </div>
    </div>
    </div>
    
    <?php 
     if(isset($_SESSION['korisnik'])):

     ?>
     <?php
       $korisnikid = $_SESSION['KorisnikId'];
       
                       
                       
                    $upit4 = "SELECT * FROM ocena WHERE KorisnikId = $korisnikid AND apartmanid=$id";
                    $rez6=$konekcija->query($upit4)->fetch();
                    
                    if($rez6){
                                echo "";
         
					}else{ ?>
                            <div class="container zvezde">
                            <div class="row">
                            <div class="col-md-7 oApartmanu" id="izdvojeno">
                            <h3> Ocena </h3>
                
         
                             <div  style="padding-top:10px;">
                                       <i class="fa fa-star fa-2x" data-index="0"></i>
                                       <i class="fa fa-star fa-2x" data-index="1"></i>
                                       <i class="fa fa-star fa-2x" data-index="2"></i>
                                       <i class="fa fa-star fa-2x" data-index="3"></i>
                                       <i class="fa fa-star fa-2x" data-index="4"></i>
                                      
                                      <br><br>
                            </div>
                              
                             
                            </div>
                            </div>
                            </div>
    
   
           <script>
     
                                var ratedIndex = -1;
                                var uID = "<?php echo $id ?>";
                                var korisnikid = "<?php echo $korisnikid ?>";
                                $(document).ready(function () {
                                    
                                    resetStarColors();
            
                                    $('.fa-star').on('click', function () {
                                       ratedIndex = parseInt($(this).data('index'));
                                       saveToTheDB();
                                    });

                                    $('.fa-star').mouseover(function () {

                                        resetStarColors();
                                        var currentIndex = parseInt($(this).data('index'));
                                        setStars(currentIndex);
                                    });

                                    $('.fa-star').mouseleave(function () {
                                        resetStarColors();

                                        if (ratedIndex != -1)
                                            setStars(ratedIndex);
                                    });
                                });

                                function saveToTheDB() {
                                    $.ajax({
                                       url: "php/upisoOcena.php",
                                       method: "POST",
                                       data: {
                                           korisnikid: korisnikid,
                                           id: uID,
                                           ratedIndex: ratedIndex
                                       }, success: function (r) {
                                            alert("Hvala sto ste glasali")
                                            location.reload();
                                       }
                                    });
                                }
        
                                function setStars(max) {
                                    for (var i=0; i <= max; i++)
                                        $('.fa-star:eq('+i+')').css('color', 'green');
                                        
                                }

                                function resetStarColors() {
                                    $(".fa-star").css("color", "white");
                                    
                                }
    
    </script>
   
     
                       
                        
   <?php }?>
                        
     
    <?php endif ?>
    </div>
    </div>
    </div>
    </div>
    
    <div class="container komentar">
    <div class="row">
    <div class="col-md-12">
     <h3> Komentari </h3>
    <hr class="hrNaslov"/>
    </div>
    </div>
        <?php if(!isset($_SESSION["korisnik"])): ?>
        <div class="row komentar">
            <p> Za ostavljanje komentara morate biti <a href="registracija.php" class="kontaktMail">ulogovani</a> . </p>
        </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-12 komentar">
            
				
                <div class="form-group">
                <form method="post" action="php/komentar.php">
                    <div class="form-row">
                    
                        <input type="hidden" name="apartmanid" value="<?=$id?>"/>
                        <textarea class="form-control" id="komentar" name="komentar" rows="3" placeholder="Vas komentar..."></textarea>
                    </div>
                    <div class="form-row">
                        <input type="submit" class="btn btn-secondary" id="btnKomentar" style="margin-top:15px;" name="btnKomentar" value="Posalji komentar">
                    </div>
                </form>
                </div>
            </div>
        </div>
        
       
        
        <?php
        $upit3="SELECT * FROM komentar k INNER JOIN korisnik kor ON k.korisnikId=kor.korisnikId 
                                        WHERE apartmanid=$id ORDER BY datum DESC";
        $rez3=$konekcija->query($upit3)->fetchAll();
        foreach ($rez3 as $item) :
        ?>
        <div class="row mb-3">
            <div class="col-md-3 komentar">
                <table>
                    <tr>
                        <td><b><?=$item->ime?> <?=$item->prezime?></b></td>
                        
                    </tr>
                    <tr>
                        <td colspan="2"><b><?=$item->datum?></b></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-9 komentar">
                <div class="col pt-2">
                            <p><b><?=$item->Komentar?></b></p>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
<?php 
include("views/footer.php");
?>

