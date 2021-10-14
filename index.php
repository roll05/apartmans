<?php
include("views/header.php");

$connect = mysqli_connect('sql103.epizy.com', 'epiz_29876556', 'Phln4yQ9ou', 'epiz_29876556_apartmans');
function make_query($connect)
{
 $query = "SELECT * FROM slikeZaSlider ORDER BY `slikeSliderid` ASC";
 $result = mysqli_query($connect, $query);
 return $result;
}

function make_slide_indicators($connect)
{
 $output = ''; 
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}

function make_slides($connect)
{
 $output = '';
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $output .= '
   <img src="'.$row["url"].'" alt="'.$row["alt"].'" />
   <div class="carousel-caption">
    <h3>'.$row["alt"].'</h3>
   </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}

?>


<?php if(isset($_SESSION['korisnik'])):
                if($_SESSION['korisnik']->ulogaId==1):?>
                 <div class="container">
                <div class="row border-top">
                    <nav class="nav ml-5 dodajApartman">
                        <a class="nav-link kontaktMail" href="dodajApartman.php">Dodaj aparman</a>
                        <a class="nav-link kontaktMail" href="korisnici.php">Korisnici</a>
                         <a class="nav-link kontaktMail" href="reklama.php">Reklame</a>
                          <a class="nav-link kontaktMail" href="rezervacije.php">Rezervacije</a>
                          
                    </nav>
                </div>
                <?php endif;?>
                <?php endif;?>
                </div>
<div class="container">
            <div class="row">
                <div class="col-md-12 wheder">
<a class="weatherwidget-io" href="https://forecast7.com/sr/43d7119d69/zlatibor/" data-label_1="ZLATIBOR" data-label_2="WEATHER" data-theme="mountains" >ZLATIBOR WEATHER</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
</div></div></div>
<div class="container">

            <div class="row">
                <div class="col-md-12" >
                    
                    
                    <div class="slider">
                    <?php 
                        $upit = "SELECT * FROM slikezaslider";
                        $rez=$konekcija->query($upit)->fetchAll();
                        foreach($rez as $image):
                    
                    ?>
                    <div><img src="<?= $image->url?>" width="100%"  height="500px" /></div>
                    
                    <?php endforeach; ?>
                   </div>
                                
            <script>
            $('.slider').bxSlider({
                autoControls: true,
                auto: true,
                pager: true,
                mode: 'fade',
                captions: true,
                speed: 10
            });     
        </script>
        
              </div>
                </div>
                  </div>

<div class="container">
            <div class="row">
                <div class="col-md-9 left">
                    <p>OVDE IDE VIDEO ZGRADE </p>
                </div>
                <div class="col-md-3 right" style="text-align:center;">
                
                      <div class="sliders">
                    <?php 
                     
                        $upit = "SELECT * FROM reklame" ;
                        $rez=$konekcija->query($upit)->fetchAll();
                        foreach($rez as $image):
                    
                    ?>
                    <div>
                        <div><img src="<?= $image->urlReklame?>" width="100%"  height="200px" /></div>
                         <div class="infoReklama"> 
                                <ul>
                                    <li style="text-align:center;"><?= $image->ime?></li>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                    </svg> &nbsp<?= $image->lokacija?></li>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745                                                 1.745 0 0 1                         1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0                                                                1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                    </svg>&nbsp<?= $image->brojTelefona?></li>
                                    </ul>
                        </div>
                        </div>
                   <?php endforeach; ?>
                   </div>
            <script>
            $('.sliders').bxSlider({
                autoControls: true,
                auto: true,
                pager: true,
                mode: 'vertical',
                captions: true,
                speed: 1000
            });
        </script>
               
                </div>
            </div>
        </div>
            
        

<?php 
include("views/footer.php");
?>