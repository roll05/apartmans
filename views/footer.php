
 
     <footer>
     <div class="container" style="opacity: 0.9;">
         <div class="row my-5 justify-content-center py-5">
             <div class="col-11">
                 <div class="row ">
                     <div class="col-xl-8 col-md-4 col-sm-4 col-8 my-auto mx-auto a">
                         <h3 class="mb-md-0 mb-5">Brzi linkovi</h3>
                     </div>
                     <div class="col-xl-2 col-md-4 col-sm-4 col-8" >
                         <h6 class="mb-3 mb-lg-4 "><b>MENU</b></h6>
                         <ul class="list-unstyled">
                        <li><a class="footerLinks" href="index.php">Home</a></li>
                        <li><a  class="footerLinks" href="rezervacija.php">Rezervation</a></li>
                        <li><a class="footerLinks" href="info.php">Info</a></li>
                         <li>     
                 <?php if(!isset($_SESSION['korisnik'])):?>
                       
                            <a class="footerLinks" href="registracija.php">Prijavi se / Registruj se</a>
                        
                        <?php endif; ?>
                        <?php if(isset($_SESSION['korisnik'])):?>
                           
                                <a class="footerLinks" href="php/logout.php">Odjavi se</a>
                            
                           
                                <?php

                                                $upit = "SELECT ime, prezime FROM korisnik WHERE KorisnikId = :idKorisnik";
                                                $priprema = $konekcija->prepare($upit);

                                                $id = $_SESSION['KorisnikId'];

                                                $priprema->bindParam(':idKorisnik',$id);

                                                $rez = $priprema->execute();

                                                if($rez){
                                                $korisnik = $priprema->fetch();
                                                echo $korisnik->ime. " " . $korisnik->prezime;
                                    }
                                                ?>
                            </li>
                        <?php endif; ?>
                    
                     </div>
                     <div class="col-xl-2 col-md-4 col-sm-4 col-8 footerLinks">
                         <h6 class="mb-3 mb-lg-4 mt-sm-0 mt-5"><b>ADRESA</b></h6>
                         <p class="mb-1">Zlatibor</p>
                        
                     </div>
                 </div>
                 <div class="row ">
                     <div class="col-xl-8 col-md-4 col-sm-4 col-auto my-md-0 mt-5 order-sm-1 order-3 align-self-end">
                         <ul class="social_footer_ul list-unstyled lista" style="display:inline;">
                <li><a href="http://webenlance.com"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="http://webenlance.com"><i class="fab fa-twitter"></i></a></li>
                <li><a href="http://webenlance.com"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="https://www.instagram.com/s_lux_zlatibor/"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                    <style>
                        .lista li{
                        font-size:25px;
                            margin-left:10px;
                            display:inline;              
						}

                    </style>
                     </div>
                     <div class="col-xl-2 col-md-4 col-sm-4 col-auto order-1 align-self-end ">
                         <h6 class="mt-55 mt-2 text"><b>Email Adresa</b></h6><small> <span><i class="fa fa-envelope" aria-hidden="true"></i></span> sluxzlatibor@gmail.com</small>
                     </div>
                     <div class="col-xl-2 col-md-4 col-sm-4 col-auto order-2 align-self-end mt-3 ">
                         <h6 class="text"><b>Broj Telefona</b></h6><small><span><i class="fa fa-envelope" aria-hidden="true"></i></span> 064....</small>
                     </div>
                 </div>
             </div>
         </div>
         </div>
     </footer>


    <script src="js/script.js"></script>
    <script src="js/slideshow.js"></script>
<script src="js/jquery.rateyo.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
</body>
</html>
