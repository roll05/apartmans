<?php 
include ("views/header.php");
if(isset($_GET["idA"])){
	if(isset($_GET["idK"])){
		if(isset($_GET["datumOd"])){
			if(isset($_GET["datumDo"])){

				$idApartmana = $_GET["idA"];
				$idKorisnika = $_GET["idK"];
				$datumDo = $_GET["datumDo"];
				$datumOd = $_GET["datumOd"];

				
			}

		}
	
	}else{
    header("Location: php/404.php");
}
}else{
    header("Location: php/404.php");
}



?>
<?php
								$upit = "SELECT * FROM apartman WHERE apartmanid = $idApartmana";
								$rez=$konekcija->query($upit)->fetchAll();
								foreach($rez as $apartmani):
						
						?>

<div class="container" style="min-height:400px;">
					<div class="row">
						<div class="col-md-12 info">

						
						
							 
							 <h4>Da li ste sigurni da zelite da proverite koja je cena za  <?= $apartmani -> naziv ?> kao i da li su slobodan termin od <?php echo $datumOd ?> do <?php echo $datumDo?>?</h4></br>
							 <?php endforeach; ?>
							 <form> 

								<input type="hidden" value ="<?php echo $datumDo ?>" name ="datumDo" id ="datumDo">
							 <input type="hidden" value ="<?php echo $datumOd ?>" name ="datumOd" id ="datumOd">
							 <input type="hidden" value ="<?php echo $idApartmana ?>" name ="idApartmana" id ="idApartmana">
							 <input type="hidden" value ="<?php echo $idKorisnika ?>"; name ="idKorisnika" id ="idKorisnika">
							 <input type='button' value='Proveri datume' class='btn btn-xs btn-primary' onclick='rezervisi()' name='Jesam'>
							 <input type='button' value='Nemoj proveriti' class='btn btn-xs btn-primary' onclick='nemojRezervisati()' name='Nisam'>
							 </form>

	
							 
						<?php
								$upit = "SELECT * FROM apartman WHERE apartmanid = $idApartmana";
								$rez=$konekcija->query($upit)->fetchAll();
								foreach($rez as $apartmani):
						
						?>
						 <div class="img" style="margin-top:30px;">
						 <h4 style="text-align : center"> <?= $apartmani -> naziv ?> </h4>
                    <img class="uredi" src="<?=$apartmani->urlSlike?>" alt="<?=$apartmani->altSlike?>">
						 </div>



							 <?php endforeach; ?>

</div>
</div>
</div>
  <script src="js/script.js"></script>
    <script src="js/slideshow.js"></script>
<script src="js/jquery.rateyo.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
