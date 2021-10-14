<?php
if(isset($_GET['email'])){

    $email = $_GET['email'];

    include("views/header.php");    
}else{
    header("Location: php/404.php");
}


?>
    <div class="container">
        <div class="row">
        <div class="col-md-12 forma" style="margin-top: 20px;">
            <form>
                <label><h4>Molimo Vas unesite novu sifru</h4></label> </br>   
            <input type="password" name="password" id="password" style="width: 40%;"><br>
             * Minimalno 8 karaktera, mora imati velika, mala slova i brojeve <br>
            <input type="password" name="rePassword" id="rePassword" style="width: 40%;"><br>
            <p class="nijeDobro"></p>
            * Sifre se moraju poklapati<br>
            <input class="btn btn-xs btn-primary" type="button" name="dugme" id="dugme" style="width: 100px;" value="Reset">
            <div id="dodatnoPoljeReg">
</div>
        </div>
            </form>
        </div>
        <script>
            $(document).ready(function(){
                $("#dugme").click(function(){
                    var email = "<?= $email ?>";
                    var password = $("#password").val();
                    var rePassword = $("#rePassword").val();
                    var regPassword=/^[A-z0-9]{8,}$/;
                    var podaci=new Array();
                    var greske=new Array();
             if(regPassword.test(password)){
                    podaci.push(password);
                }
                else {
                    greske.push(password);
                    document.querySelector("#password").style.border="1px solid red";
                }
                if(rePassword != password){
                    greske.push(rePassword);
                    document.rePassword("#password").style.border="1px solid red";
                    document.rePassword("#nijeDobro").html = "Sifre moraju biti iste";
                }
                if(greske.length>0) {
            document.querySelector("#dodatnoPoljeReg").innerHTML="Polja nisu dobro popunjena.";
                            }
                            else {
                                $.ajax({
                                    url: "php/UpdatePassword.php",
                                    method: "post",
                                    data: {
                                        email: email,
                                        password: password,
                                        btnReg:true
                                    },
                                    success: function (podaci) {
                                        if (podaci == "") {
                                            alert("Uspesno ste promenili sifru!")
                                            window.location = "registracija.php";
                                        } else {
                                            alert(podaci);
                                            window.location = "registracija.php";
                                        
                                        }


                                    },
                                    error: function (xhr, statuss) {
                                        let status=xhr.status;
                                        if(status==500){
                                            alert("greska na serveru");
                                        }
                                        else if(status==404){
                                            alert("Nije moguce promeniti sifru ovom korisniku,kontaktirajte administratora za vise informacija");
                                        }
                                        else {
                                            alert("greska" + statuss + status);
                                        }
                                    }

                                });
                            }

                        

                })



            })

           </script> 
    </div>

<?php
    require("views/footer.php");

?>