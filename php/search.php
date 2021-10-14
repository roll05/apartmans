<?php
 include "konekcija.php";

 if(isset($_POST["search"])){
 
 $search = $_POST["form1"];
 $search = preg_replace("#[^0-9a-z]#","",$search);

 $upit = "SELECT * FROM apartmani WHERE naziv LIKE '%$search%' OR opis LIKE '%$search%' ";


 }

 ?>