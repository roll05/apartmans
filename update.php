<?php
include("views/header.php");
include ("php/konekcija.php");
 if(isset($_SESSION['korisnik'])){
        if($_SESSION['korisnik']->ulogaId != 1){
            header("Location: index.php");
        }
    }
    else {
        $_SESSION['greska'] ="Niste ulogovani!";
        header("Location: index.php");
    }
?>
    <?php
     if(isset($_GET['id'])){
            $id=$_GET['id'];
           
     
            $upit="SELECT apartmanid, naziv, opis, lokacija, cenaid, urlSlike, altSlike FROM apartman WHERE apartmanid = $id";
             $rez=$konekcija->query($upit)->fetch();
        
        }?>
    <div class="container aparmani">
    <hr class="hrNaslov"/>
    <div class="row">
    <div class="col-md-6 input">
    <form method="post" action="php/updateApartman.php" enctype="multipart/form-data">
    <table>
<?php 

     foreach ($rez as $item  => $value):
     ?>
            
            <tr><td><?=$item?></td></td>
            <?php 
            if($item == "opis"){?>
            <tr><td > <textarea class="btn btn-secondary" cols="50"  rows="3" name="<?=$item?>" id="<?=$item?>" ><?=$value?></textarea></td></tr>
            <?php }elseif ($item == "apartmanid") { ?>
	        <tr><td colspan="3"> <input type="text" class="btn btn-secondary input" value='<?=$value?>' readonly="readonly" name="<?=$item?>" id="<?=$item?>" ></td></tr>
            <?php }elseif ($item == "urlSlike") { ?>
	        <tr><td colspan="3"> <input type="text" class="btn btn-secondary input" value='<?=$value?>' readonly="readonly" name="<?=$item?>" id="<?=$item?>" ></td></tr>
            <?php }else{ ?>
            <tr><td colspan="3"> <input type="text" class="btn btn-secondary input" value='<?=$value?>' name="<?=$item?>" id="<?=$item?>" ></td></tr>
            <?php } ?>
            <?php
            endforeach;
            ?>
             
            <tr><td>Slika za zamenu avatara ukoliko zelis</td></td>
            <tr><td> <input type="file" id="updateAvatar" name="updateAvatar" accept=".jpg, .png, .jpeg, .gif"></td></tr>
       <tr><td> <input type="submit" class="btn btn-secondary" name="updateApartman" value="Izmeni"> </td></tr>
       </table>
       </form>
       </div>
       
     
    
    <div class="col-md-6 input">
    <img id="setPicture" alt="picture with that id" width="100%" height="auto"/> 
        <script>
        var slika = document.getElementById("urlSlike").value;
        console.log(slika);
       document.getElementById("setPicture").src= slika;
        </script>
       
    </div>
    </div>
       </div>

<?php 
include("views/footer.php");
?>