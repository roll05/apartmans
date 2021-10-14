<?php include("views/header.php");
  include("php/konekcija.php");
  $output = "";
  $outpur1 = "";
   $strana=0;
  $upit="SELECT * FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid WHERE apartmanid limit $strana, 8";
 if(isset($_POST["search"])){
 $search = $_POST["form1"];
    $upit = "SELECT * FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid WHERE apartmanid AND naziv LIKE '%$search%' limit $strana, 8";
  $rez=$konekcija->query($upit)->fetchAll();
  $count  = count($rez);
    if($count == 0){
     $output = "Nema to sto trazite";
    }else {
       foreach($rez as $iteam):

        $id = $iteam->apartmanid;
        $slika =$iteam->urlSlike;
       
        
		endforeach ;
       
	 }
 
 }

 

?>
	
	<div class="container search">
		 <div class="row">
				<div class="col-md-6">
                <form method = "post" action="rezervacija.php">
                <table>
                <tr>
                <td width="80%">
					<input type="search" id="form1" placeholder="search..." name="form1"  style="width: 100%;"/>
                    </td><td>
                    <input type="submit" id="search" name="search" value="Search" class="btn btn-xs btn-primary">
                    </td><tr>
                    </table>
                   </form>
                   <?php 
                   echo $outpur1;
                   ?>

				</div>
				
				<div class="col-md-6">
                <form method="post" action="rezervacija.php" >
					<select name="ddlistFilter" id="ddlistFilter">
						<option value="0">Izaberite filter</option>
						<option value="1">Cena opadajuca</option>
						<option value="2">Cena rastuca</option>
						<option value="3">Najbolje ocenjeni apartmani</option>
					</select>
                <input type="submit" id="filter" name="filter" value="Primeni Filter" class="btn btn-xs btn-primary">
                </form>
                </div>
		 </div>
	</div>
<!--Odavde pocinje strana-->

  <div class="container aparmani">
    <h1 class="naslov">Apartmani</h1>
    <hr class="hrNaslov"/>
    <div class="row">
    <?php 
    echo $output;
    ?>
    <script>
    var demoRatings =[];
    </script>
        <?php
        $strana;
            if(isset($_GET['strana'])) {
            $strana = ($_GET['strana'] - 1) * 8;
        }
       
       if(isset($_POST["filter"])){
    $strana=0;
    $ddlista = $_POST["ddlistFilter"];
    if($ddlista == 1){
         $upit="SELECT *, CAST(c.vrednost AS int) AS vrednost_int FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid WHERE apartmanid ORDER BY vrednost_int DESC limit $strana, 8";
	}else if($ddlista == 2){
         $upit="SELECT *, CAST(c.vrednost AS int) AS vrednost_int FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid WHERE apartmanid ORDER BY vrednost_int ASC limit $strana, 8";
	} elseif($ddlista == 3){
        $upit="SELECT * FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid INNER JOIN ocena o ON o.apartmanid = a.apartmanid WHERE a.apartmanid GROUP BY a.apartmanid ORDER BY AVG(ocena) DESC  limit $strana, 8";
	}//else{
     //    $upit="SELECT * FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid WHERE apartmanid limit $strana, 8";;
	//}


 }else{
  $upit="SELECT * FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid WHERE apartmanid limit $strana, 8";
 }
        
        $rez=$konekcija->query($upit)->fetchAll();
       
        foreach($rez as $apartmani):?>
            <div class="col-md-6 uredi" id="izdvojeno">
                <div class="img">
                    <img class="uredi" src="<?=$apartmani->urlSlike?>" alt="<?=$apartmani->altSlike?>">
                
                <div class="description ">
                    <h5><?=$apartmani->naziv?></h5>
                    </div>
                    
                    <?php 
                    
                        $idApartman = $apartmani->apartmanid;
                        
                         $upit2 = "SELECT AVG(ocena) AS prosekOcena FROM ocena WHERE apartmanid = $idApartman";
                        $rez2=$konekcija->query($upit2)->fetch();
                        foreach ($rez2 as $ite => $vrednost):
                        
                         ?>
                
                         <div class="rateYo"></div>
                        
                             
                        <script>
                        
                           $(function () {
                           var vrednost = "<?php echo $vrednost?>";
                           if(vrednost == ""){
                            vrednost = "0";              
						   }
                           demoRatings.push(vrednost);
                           
                          })
                           
                            </script>
                             
                       
                    
                      <?php 
                      if($apartmani->cenaid == 23){
                      ?>
                       <h7><b>Cena po noci : <?=$apartmani->vrednost?> </b></h7>
                      <?php 
                      }else{
                      ?>
                       <h7><b>Cena po noci : <?=$apartmani->vrednost?>&euro;</b></h7>
                      <?php }
                      ?>
    
                    <?php 
                    
                    $opis=$apartmani->opis;
                    $sub=substr($opis,0,150);
                    ?>
                    <p><?=$opis." ..."?></p>
                </div>
                <div class="aTag">
                    <a href="apartman.php?id=<?=$apartmani->apartmanid?>" class="procitajVise ml-4 pt-1">Progledaj vise</a style="text-decoration:none;" style="bottom:0;" >
                    <?php if(isset($_SESSION['korisnik'])):
                         if($_SESSION['korisnik']->ulogaId == 1 ):?>
                            <div class="mr-3 p-2 aTag">
                                <?php include("php/delete.php");?>
                                <a href="update.php?id=<?=$apartmani->apartmanid?>"  class="procitajVise update">Update</a>
                                <a href="php/delete.php?id=<?=$apartmani->apartmanid?>"  class="procitajVise delete" name="delete" id="delete">Delete</a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach;?>
         <?php endforeach; ?>
    </div>
    <script>
     $(function () {
      stars       = $('.rateYo');
    stars.each(function(i) {
  $(this).rateYo({
    halfStar: true,
    rating: demoRatings[i],
    readOnly: true
  })
  })
  })
     </script>
    <hr class="hrNaslov"/>
    <div class="row m-0 p-0">
        <div class="col-md-1" style="text-align:center;">
            <ul class="pagination pagination-lg">
                <?php

                if(isset($_POST["filter"])){
                $strana=0;
                
                 $ddlista = $_POST["ddlistFilter"];
                     if($ddlista == 1){
                          $upit1="SELECT COUNT(*) as brPrikaza FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid WHERE apartmanid ORDER BY c.vrednost DESC";
	                 }else if($ddlista == 2){
                       $upit1="SELECT COUNT(*) as brPrikaza FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid WHERE apartmanid  ORDER BY c.vrednost ASC ";
	                     } elseif($ddlista == 3){
                     $upit1="SELECT COUNT(*) as brPrikaza FROM apartman a INNER JOIN cena c ON a.cenaid = c.cenaid INNER JOIN ocena o ON o.apartmanid = a.apartmanid WHERE a.apartmanid GROUP BY a.apartmanid ORDER BY AVG(ocena) DESC";}
	                $rez1 = $konekcija->query($upit1)->fetch();
                $brPrikaza = $rez1->brPrikaza;
                $brLinkova = ceil($brPrikaza / 8);
                for($i=1; $i <= $brLinkova; $i++):?>
                    <li class="page-item"><a class="page-link" href="rezervacija.php?strana=<?=$i?>" style="color:#222"><?=$i?></a></li>
                <?php endfor;?>
                <?php


           }else{
                
				
                $upit1 = "SELECT COUNT(*) as brPrikaza FROM apartman";
                $rez1 = $konekcija->query($upit1)->fetch();
                $brPrikaza = $rez1->brPrikaza;
                $brLinkova = ceil($brPrikaza / 8);
                for($i=1; $i <= $brLinkova; $i++):?>
                    <li class="page-item"><a class="page-link" href="rezervacija.php?strana=<?=$i?>" style="color:#222"><?=$i?></a></li>
                <?php endfor;
                
                }?>
                
            </ul>
        </div>
    </div>
    </div>
    
   
    

    

<?php
include("views/footer.php");
?>