<?php
include("views/header.php");
?>
<div class="container">
<div class="row">
        
        <img src="img/registracija.png" style="width:100% !important;" class="img-fluid" alt="Registracija">
    </div>
    </div>
<div class="container">
    <div class="row">
    <div class="col-md-6 forma" style="margin-top: 20px;">
            <h3>Registruj se</h3>
            <form method="POST">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Ime" id="tbIme" name="tbIme">
                            <label class="label"> *Ime mora da pocinje sa velikim slovom. </label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Prezime" id="tbPrezime" name="tbPrezime">
                            <label class="label"> *Prezime mora da pocinje sa velikim slovom. </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Broj telefona" id="brTelefona" name="brTelefona">
                            

                            <input type="password" class="form-control" placeholder="Šifra" id="password" name="password">
                            <label class="label mb-0"> * Minimalno 8 karaktera, mora imati velika, mala slova i brojeve </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                        <input type="text" class="form-control" placeholder="E-mail" id="email" name="email">
                        <label class="label"> *Email mora da bude postojeci. </label>
                    </div>
                    </div>
                    <div class="form-row" id="dodatnoPoljeReg">

                    </div>
                    <div class="form-row">
                        <script src="js/registracija.js"></script>
                        <input type="button" class="btn btn-secondary" id="btnReg" name="btnReg" value="Registruj se" onclick="konzola()"/>
                    </div>
                </form>
    </div>
     <div class="col-md-6 forma" style="margin-top: 20px;">
            <h3>Prijavi se</h3>
            <form method="POST">
                <div class="form-row">
                    <input type="text" class="form-control" placeholder="E-mail" id="emailLog" name="emailLog">
                </div>
                <div class="form-row">
                        <input type="password" class="form-control" placeholder="Šifra" id="passwordLog" name="passwordLog">
                </div>
                <div>
                    <a class="zaboravio" href="" style="text-decoration:none;">Zaboravio sam lozinku.</a>
                </div>
                <script>
                $(document).ready(function(){
                    $(".zaboravio").hover(function(){
                        $(this).css("text-decoration", "underline");
                    },function(){
                        $(this).css("text-decoration", "none");
                    })
                    $(".zaboravio").click(function(){
                        alert("Ceo kod radi.Problem je sto je sajt okacen na free hostu i oni mi ne dozvoljavaju taj kod da postavim.")
                    })

                })

                </script>
                <div class="form-row" id="dodatnoPolje">

                </div>
                <div class="form-row">
                    <script src="js/login.js"></script>
                    <input type="button" class="btn btn-secondary" id="btnLog" name="btnLog" value="Prijavi se" onclick="prijava()"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
include("views/footer.php");
?>
