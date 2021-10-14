<?php include("views/header.php");
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
?>
<div class="container">
    <div class="row">
 <div class="col-md-6 border border-sencondary rounded" style="z-index:1;" style="opacity:0.9;">
                <h3>Dodaj sliku</h3>
            <hr/>
                <div style="opacity: 0.9;">
                <label class="label"> <b>Upis slike za slider </b></label>
                </div>
                 <form method="POST" action="php/upisZaSlider.php" enctype="multipart/form-data">
    <div class="form-row style="z-index:1;" style="opacity:0.9;"">
                <div class="col p-3">
                <label class="ml-0"> Dodaj sliku </label>
                <input type="file" class="form-control-file" id="images" multiple="" name="images" accept=".jpg, .png, .jpeg">
                </div>
            
            </div>
            
            <input type="submit" class="btn btn-secondary" id="uploadSliku" name="uploadSliku" value="Upisi"/>
            
           
        </div>
    </form>
     <div class="col-md-6 border border-sencondary rounded" style="z-index:1;" style="opacity:0.9;">
                <h3>Dodaj sliku</h3>
            <hr/>
                <div style="opacity: 0.9;">
                <label class="label"><b> Upis slike za Reklamu</b> </label>
                </div>
                 <form method="POST" action="php/upisreklame.php" enctype="multipart/form-data">
                    <div class="form-row style="z-index:1;" style="opacity:0.9;"">
                        <div class="col p-3">
                        <label class="ml-0"> Dodaj sliku </label>
                        <input type="file" class="form-control-file" id="image" multiple="" name="image" accept=".jpg, .png, .jpeg"></br>
                        <label>Unesi ime Reklame</label>
                        <input type="text" name="name" id="name" ></br>
                        <label>Unesi Lokaciju</label>
                        <input type="text" name="lokacija" id="lokacija" ></br>
                        <label>Unesi broj telefona</label>
                        <input type="text" name="brtelefona" id="brtelefona" >
                        </div>
                    
                    </div>
            
            <input type="submit" class="btn btn-secondary" id="upload" name="upload" value="Upisi"/>
            </div>
        </div>
    </form>
    </div>
    </div>
    <div class="container">
    <div class="row">
    <div class="col-md-6" style="z-index:1;" style="opacity:0.9;">
    
        <?php 
        $upit = "SELECT * FROM slikezaslider";
        $rez=$konekcija->query($upit)->fetchAll();
        foreach($rez as $slike):?>
        <div class="col-md-3 slike">
        <img src="<?=$slike->url?>" width="120px" height="120px" style="margin-top:10px;">
        <a style="margin-top:10px;" class="btn btn-secondary deleteSlikuSlidera" data-id="<?=$slike->slikeSliderid ?>">Delete</a></div>
        <?php endforeach; ?>
        
        <script>
            $(document).ready(function() {
                $(".deleteSlikuSlidera").click(function(){
                    var id=$(this).data('id');
                    console.log(id);
                    $.ajax({
                        method:"POST",
                        url:"php/deleteSlikeZaSlider.php",
                        data:{
                            id:id,
                            dugme:true
                        },
                        success: function () {
                        alert("Uspesno ste izbrisali Sliku");
                        location.reload();
                        },
                        error:function(xhr, statuss){
                            let status=xhr.status;
                            switch (status) {
                                case 500:
                                    alert("Problem na serveru,nije moguce u ovom trenutku izbrisati reklamu.");
                                    break;
                                case 404:
                                    alert("Stranica nije pronadjena");
                                    break;
                                default:
                                    alert("Error: " + status + " - " + statuss);
                                    break;
                            }
                        }
                    })
            })})
        </script>
    </div>
     <div class="col-md-6" style="z-index:1;" style="opacity:0.9;">
      <?php 
        $upit = "SELECT * FROM reklame";
        $rez=$konekcija->query($upit)->fetchAll();
        foreach($rez as $slike):?>
        <div class="col-md-3 slike">
        <img src="<?=$slike->urlReklame?>" width="120px" height="120px" style="margin-top:10px;">
        <a style="margin-top:10px;" class="btn btn-secondary deleteReklamu" data-id="<?=$slike->reklamaid ?>">Delete</a></div>
        <?php endforeach; ?>
        <script>
            window.onload=function () {
                $(".deleteReklamu").click(function(){
                    let id=$(this).data('id');

                    $.ajax({
                        method:"POST",
                        url:"php/deleteReklamu.php",
                        data:{
                            id:id,
                            dugme:true
                        },
                        success: function () {
                        alert("Uspesno ste izbrisali Sliku");
                        location.reload();
                        },
                        error:function(xhr, statuss){
                            let status=xhr.status;
                            switch (status) {
                                case 500:
                                    alert("Server error, it is not possible to delete post at this moment.");
                                    break;
                                case 404:
                                    alert("Page not found");
                                    break;
                                default:
                                    alert("Error: " + status + " - " + statuss);
                                    break;
                            }
                        }
                    })
            })}
        </script>
     </div>
    </div>
    </div>