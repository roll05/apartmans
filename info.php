<?php
include("views/header.php");
?>
<div class="container">
<div class="row">
	<div class="col-md-12">
<div class="kontaktimg">
    <img src="img/contact.png" class="img-fluid" alt="Kontakt">
</div>
</div>
</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>Info</h3>
			<hr>
				</div>
		</div>
	</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12 info">
									<p>Mi smo novi u ovom poslu i krenuli smo da iznajmljujemo apartmane relativno skoro.Nadamo se da ce te kod nas naci najbolje apartmane po najpovoljnijim 
										cenama.U okviru naseg asortimana mozete <b>potpuno besplatno</b> koristiti spa centar koji se nalazi u okviru zgrade.Tokom ranijih iskustava imali smo dosta posetilaca i svi su 
										se slozili oko istog, da je nasa ponuda apartmana jedna od najboljih zato Vas ocekujemo da dodjete kod nas i pogledate sta mi pruzamo i ucerite se u nas kvalitet. </p>
										<p>Nalazimo se u ulici Kofska 8 na Zlatiboru.Od centra grada je na 5min.U okolini imate sve sto vam je potrebno za odmor,od prodavnica i kafica do planine sa ski stazama. </p>
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1143.120105655391!2d19.700374149830054!3d43.73151290907507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47582fca2eb765c9%3A0x559c70932a345697!2sZlatiborska%20Vila%204!5e0!3m2!1ssr!2srs!4v1612730093447!5m2!1ssr!2srs" width="100%" height="300px" frameborder="0" style="border:0;" style="text-align:center;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
										
							</div>		
						
							</div>
				
					</div>

					<div class="container">
							<div class="row">
								<div class="col-md-12">
										<h3 style="text-align:left;">Contact</h3>
										</hr>
									</div>
								
								</div>
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-12 info" >
				         <p>Nalazimo se u ulici kofska 8 na Zlatiboru.Od centra grada je na 5min.U okolini imate sve sto vam je potrebno za odmor,od prodavnica i kafica do planine sa ski stazama.</p>
							<p>Ukoliko zelite da nas kontaktirate to mozete uraditi na broj : <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
								</svg> +38164 3242342. Svakog radnog dana od 08-22h 
								</p>
							
							<p>Ukoliko zelite da nam posaljete e-mail to mozete uraditi preko : <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text-fill" viewBox="0 0 16 16">
								<path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
								</svg> sluxzlatibor@gmail.com bilo kad ili jednostavno mozete da popunite sta vas zanima ispod i posaljete nam direktno email. </p>
					
						</div>
					
					</div>
			</div>
		
		<div class="container">
		<div class="row">		
		<div class="col-md-12 sendEmail">
		
		<?php 
			
			
			if(isset($_SESSION['KorisnikId'])){
			$id = $_SESSION['KorisnikId'];
			$upit = "SELECT email,ime FROM korisnik WHERE KorisnikId = $id";
			$rez=$konekcija->query($upit)->fetchAll();
			foreach($rez as $email):
			
		?>
		<form class="form" >
		<table class="table">
		<input type="hidden" id="ename" name="ename" value="<?=$email->email?>" >
		<input type="hidden" id="name" name="name" value="<?=$email->ime?>" >
		<tr><td>Subject &nbsp&nbsp&nbsp<input type="text" id="tema" name="tema"></td></tr>
		<tr><td colspan="2"><textarea placeholder="Plesae insert youe messages" rows="4" cols="40"  id="sadrzaj" name="sadrzaj" ></textarea></td></tr>
		<tr><td colspan="2" ><input type="button" id="sendEmail" class="button" name="sendEmail" value="Send Email" ></td></tr>
		<p class="columnOcena"></p>
		<?php endforeach; ?>
		</table>
		</form>
			
			
			<script>

				$(document).ready(function(){

				$("#sendEmail").click(function(){
				var email = $("#ename").val();
				var subject = $("#tema").val();
				var sadrzaj = $("#sadrzaj").val();
				var name = $("#name").val();
					
					console.log(name,sadrzaj,subject,email);
					if (subject != ""  && sadrzaj != "") {
					
						$.ajax({

							url: "php/sendEmail.php",
							method: "POST",
							data: {
								name : name,
								email : email,
								subject : subject,
								sadrzaj : sadrzaj,
								sendEmail: true
							},
							success: function (podaci){
							//location.reload();
							
								
							
								}


            
								 });
					
				}
				alert("Uspesno ste poslali e-mail.Nadamo se da cemo u sto kracem roku da Vam odgovorimo. Hvala na razumevanju.");
				//location.reload();
				
				
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
			
		
		<?php }else{ ?>
			<p>Da bi ste poslali email morate se prvo ulogovati<p>
			<?php }?>
			
		</div>
	</div>
</div>

<?php 
include("views/footer.php");
?>