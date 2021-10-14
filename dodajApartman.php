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

<main class="container upisApartmana">
    <div class="row" style="opacity: 0.9;">
        <h1 class="naslov">Dodaj apartman</h1>
    </div>
    <hr class="hrNaslov"/>
    <div class="container">
        <div class="row" style="opacity: 0.9;">
    <div class="col-md-7 border border-sencondary rounded">
        <div>
            <label class="label"> * Sva polja su obavezna </label>
        </div>
    <form method="POST"  action="php/upisApartmana.php" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-row" style="opacity: 0.9;">
                <div class="col">
                <label class="ml-0"> Naziv apartmana</label>
                <input type="text" class="form-control" id="nazivApartmana" name="nazivApartmana">
                </div>
                <div class="col" style="opacity: 0.9;">
                    <label>Opis</label>
                    <textarea class="form-control" id="opisApartmana" name="opisApartmana" cols="50" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row" style="opacity: 0.9;">
                <div class="col">
                <label class="ml-0"> Lokacija </label>
                <input type="text" class="form-control" id="lokacija" name="lokacija">
                </div>
                </div>
                <div class="form-row">
                            <div class="col">
                            <label class="ml-0">Cena za noc</label>
                            <select class="form-control" id="ddlCenaApartman" name="ddlCenaApartman">
                                <option selected>Izaberi...</option>
                                <?php
                                $upit="SELECT * FROM cena";
                                $rez=$konekcija->query($upit)->fetchAll();
                                foreach ($rez as $item):?>
                                    <option value="<?=$item->cenaid?>"><?=$item->vrednost?></option>
                                <?php endforeach;?>
                            </select>
                            </div>
                        </div>
                <div class="col" style="opacity: 0.9;">
                    <label class="ml-0"> Dodaj sliku </label><br>
                <input type="file" id="avatar" name="avatar" accept=".jpg, .png, .jpeg, .gif">
                </div>
                 
                <div class="col" style="opacity: 0.9;">
            <input type="submit" class="btn btn-secondary" id="btnUpis" name="btnUpis" value="Upiši"/>
            </div>
            </form>
            <div class="form-row" id="dodatnoPoljeUpis" style="z-index:1;" style="opacity:0.9;">
        
            </div>
        </div>
    </div>  
         
        <div class="col-md-5 border border-sencondary rounded" style="z-index:1;" style="opacity:0.9;">
                <h3>Dodaj sliku</h3>
            <hr/>
                <div style="opacity: 0.9;">
                <label class="label"> * Sva polja su obavezna </label>
                </div>
                 <form method="POST" action="php/upisSlike.php" enctype="multipart/form-data">
    <div class="form-row style="z-index:1;" style="opacity:0.9;"">
                <div class="col">
                <label class="ml-0"> Dodaj sliku </label>
                <input type="file" class="form-control-file" id="fSlika" multiple="" name="fSlika[]" accept=".jpg, .png, .jpeg">
                </div>
            
            </div>
            <div class="form-row style="z-index:1;" style="opacity:0.9;"">
                <div class="col">
                <label class="ml-0"> Opis slike(alt) </label>
                <input type="text" class="form-control" id="alt" name="alt">
                </div>
            </div>
             <div class="form-row">
                            <div class="col">
                            <label class="ml-0">Koja je apartman</label>
                            <select class="form-control" id="ddlSlikaApartman" name="ddlSlikaApartman">
                                <option selected>Izaberi...</option>
                                <?php
                                $upit="SELECT * FROM apartman";
                                $rez=$konekcija->query($upit)->fetchAll();
                                foreach ($rez as $item):?>
                                    <option value="<?=$item->apartmanid?>"><?=$item->naziv?></option>
                                <?php endforeach;?>
                            </select>
                            </div>
                        </div>
            <div class="col">
            <input type="submit" class="btn btn-secondary" id="btnUpisSlike" name="btnUpisSlike" value="Upiši"/>
            </div>
        </div>
    </form>
    
    </div>
     </main>