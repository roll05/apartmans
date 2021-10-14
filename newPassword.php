<?php 
    require("views/header.php");
?>
    <div class="container">
        <div class="row">
        <div class="col-md-12 forma" style="margin-top: 20px;">
            <form method="post" action="php/newPassword.php">
                <label><h4>Molim Vas unesite vas email</h4></label> </br>   
            <input type="text" name="email" id="email" style="width: 40%;"><br></br>

            <input class="btn btn-xs btn-primary" type="submit" name="dugme" id="dugme" style="width: 100px;" value="Reset">

        </div>
            </form>
        </div>
    </div>

<?php
    require("views/footer.php");

?>