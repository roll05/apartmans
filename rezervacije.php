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

    $upit="SELECT datumOd,datumDo,k.ime,k.prezime,r.rezervacijaid, k.brojTelefona, k.email, aktivan FROM rezervacija r INNER JOIN apartman a ON a.apartmanid = r.apartmanid INNER JOIN korisnik k ON k.KorisnikId=r.KorisnikId ORDER BY datumRezervacije DESC";
    
    if(isset($_POST["primeni"])){
    $ddlista = $_POST["KojeRezervacije"];
    if($ddlista == 0){
         $upit="SELECT datumOd,datumDo,k.ime,k.prezime,r.rezervacijaid, k.brojTelefona, k.email, aktivan FROM rezervacija r INNER JOIN apartman a ON a.apartmanid = r.apartmanid INNER JOIN korisnik k ON k.KorisnikId=r.KorisnikId ORDER BY datumRezervacije DESC";
	}elseif($ddlista == 1){
         $upit="SELECT datumOd,datumDo,k.ime,k.prezime,r.rezervacijaid, k.brojTelefona, k.email, aktivan FROM rezervacija r INNER JOIN apartman a ON a.apartmanid = r.apartmanid INNER JOIN korisnik k ON k.KorisnikId=r.KorisnikId WHERE aktivan = '1' ORDER BY datumRezervacije DESC";
	}elseif($ddlista == 2){
         $upit="SELECT datumOd,datumDo,k.ime,k.prezime,r.rezervacijaid, k.brojTelefona, k.email, aktivan FROM rezervacija r INNER JOIN apartman a ON a.apartmanid = r.apartmanid INNER JOIN korisnik k ON k.KorisnikId=r.KorisnikId WHERE  aktivan = '0' ORDER BY datumRezervacije DESC";
	}

    }
 if(isset($_POST["dugme"])){
 $search = $_POST["email"];
    $upit = "SELECT datumOd,datumDo,k.ime,k.prezime,r.rezervacijaid, k.brojTelefona, k.email, aktivan FROM rezervacija r INNER JOIN apartman a ON a.apartmanid = r.apartmanid INNER JOIN korisnik k ON k.KorisnikId=r.KorisnikId WHERE k.email LIKE '%$search%' ORDER BY datumRezervacije DESC";
  $rez=$konekcija->query($upit)->fetchAll();
  $count  = count($rez);
    if($count == 0){
     $outpur1 = "Nema to sto trazite";
    }else {
       foreach($rez as $iteam):

        
        $output = "
        <tr>
            <th scope='row'><?=$iteam->rezervacijaid ?></th>
            <td><?=$iteam->ime?> <?=$iteam->prezime?></td>
            <td><?=$iteam->email?></td>
            <td><?=$iteam->brojTelefona?></td>
            <td><?=$iteam->datumOd?></td>
            <td><?=$iteam->datumDo?></td>
            <td><?=$iteam->aktivan?></td>
            <td><a class='btn btn-secondary deleteRezervaciju' data-id='<?=$iteam->rezervacijaid ?>'>Delete</a></td>
             <td><a class='btn btn-secondary UpdateRezervaciju' data-id='<?=$iteam->rezervacijaid ?>'>Update</a></td>
        </tr>";
        
		endforeach ;
       
	 }
 
 }


?>


        <div class="container rezervacija">
            <div class="row">
                <div class="col-md-6" >
                     <h3> Rezervacije </h3> 
                        <h3 style="text-align:left;"><?php  echo date("Y-m-d"); ?></h3>
                        </div>
                         <div class="col-md-6" >
                         <form method="Post" action="rezervacije.php">
                        <select style="text-align:right;" name="KojeRezervacije" id="KojeRezervacije"> 
                        <option value = "0">Sve Rezervacije</option>
                        <option value="1"> Aktivne Rezervacije</option>
                        <option value="2"> Neaktivne Rezervacije</option>
                        </select></br>
                        <input type="submit" id="primeni" name="primeni" value="Primeni" style="margin-top:10px;"></br>
                        <label style="margin-top:15px;">Unesi E-mail</label></br>
                        <input type="text" id="email" name="email" style="margin-top:10px; width:40%;" ></br>
                        <input type="submit" id="dugme" name="dugme" value="Pretrazi" style="margin-top:10px;">
                        </form>
                        </div>

                        

                         <div class="col-md-12" >
                        <hr class="hrNaslov"/>
                        

                        

                        <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ime Prezime</th>
            <th scope="col">E-mail</th>
            <th scope="col">Broj Telefona</th>
            <th scope="col">datumOd</th>
            <th scope="col">datumDo</th>
            <th scope="col">Aktivan</th>
            <th scope="col">Obriši</th>
            <th scope="col">Promeni</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $upit;
        $rez=$konekcija->query($upit)->fetchAll();
        foreach($rez as $rezervacija):
        ?>
        <tr>
            <th scope="row"><?=$rezervacija->rezervacijaid ?></th>
            <td><?=$rezervacija->ime?> <?=$rezervacija->prezime?></td>
             <td><?=$rezervacija->email?></td>
            <td><?=$rezervacija->brojTelefona?></td>
            <td><?=$rezervacija->datumOd?></td>
            <td><?=$rezervacija->datumDo?></td>
            <td> <?=$rezervacija->aktivan?> <input type="text" class="aktivan" name="aktivan"></td>
            <td><a class="btn btn-secondary deleteRezervaciju" data-id="<?=$rezervacija->rezervacijaid ?>">Delete</a></td>
             <td><a class="btn btn-secondary UpdateRezervaciju" data-id="<?=$rezervacija->rezervacijaid ?>">Update</a></td>
        </tr>
        <?php endforeach; ?>
         <script>
            window.onload=function () {
                $(".UpdateRezervaciju").click(function(){
                    let id=$(this).data('id');
                    var aktivan = $(".aktivan").val();
                    $.ajax({
                        method:"POST",
                        url:"php/UpdateRezervaciju.php",
                        data:{
                            id:id,
                            aktivan:aktivan,
                            dugme:true
                        },
                        success: function (podaci) {
                        console.log(podaci);
                        alert("Uspesno ste updateovali rezervaciju");
                        location.reload();
                        },
                        error:function(xhr, statuss){
                            let status=xhr.status;
                            switch (status) {
                                case 500:
                                    alert("Server greska,nije moguce izvrsiti update u ovom trenutku.");
                                    break;
                                case 404:
                                    alert("Stranica nije pronadjena");
                                    break;
                                default:
                                    alert("Greska: " + status + " - " + statuss);
                                    break;
                            }
                        }
                    })
                })
                $(".deleteRezervaciju").click(function(){
                    let id=$(this).data('id');

                    $.ajax({
                        method:"POST",
                        url:"php/deleteRezervaciju.php",
                        data:{
                            id:id,
                            dugme:true
                        },
                        success: function (podaci) {
                        console.log(podaci);
                        alert("Uspesno ste izbrisali rezervaciju");
                         location.reload();
                        },
                        error:function(xhr, statuss){
                            let status=xhr.status;
                            switch (status) {
                                case 500:
                                    alert("Server greska,nije moguce izvrsiti delete u ovom trenutku.");
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
            })}
        </script>
        </tbody>
    </table>

	
        </div>
        </div>
        </div>
	


	


