<?php include("views/header.php");
if(isset($_SESSION['korisnik'])){
        if($_SESSION['korisnik']->ulogaId != 1){
            header("Location: index.php");
        }
    }
    ?>

<main class="container korisnici">
    <h1 class="naslov"> Korisnici </h1>
    <hr class="hrNaslov"/>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ime</th>
            <th scope="col">Prezime</th>
            <th scope="col">E-mail</th>
            <th scope="col">Broj Telefona</th>
            <th scope="col">Sifra</th>
            <th scope="col">Uloga</th>
            <th scope="col">verification</th>
            <th scope="col">Edituj</th>
            <th scope="col">Obriši</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $upit="SELECT * FROM korisnik";
        $rez=$konekcija->query("$upit")->fetchAll();
        foreach($rez as $kor):
        ?>
        <tr>
            <th scope="row"><?=$kor->KorisnikId ?></th>
            <td><?=$kor->ime?></td>
            <td><?=$kor->prezime?></td>
            <td><?=$kor->email?></td>
            <td><?=$kor->brojTelefona?></td>
            <td><?=$kor->password?></td>
            <td><?=$kor->ulogaId?></td>
            <td><?=$kor->verification?></td>
            <td><a href="updateKorisnika.php?id=<?=$kor->KorisnikId ?>" title="Izbriši korisnika"  data-id="<?=$kor->KorisnikId ?>" class="btn btn-secondary update">Update </a></td>
            <td><a class="btn btn-secondary delete" data-id="<?=$kor->KorisnikId ?>">Delete</a></td>
        <script>
            window.onload=function () {
                $(".delete").click(function(){
                    let id=$(this).data('id');

                    $.ajax({
                        method:"POST",
                        url:"php/deleteKorisnik.php",
                        data:{
                            id:id,
                            dugme:true
                        },
                        success: function () {
                        alert("Uspesno ste izbrisali korisnika");
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
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
<!--<script src="js/delete.js"></script>-->
