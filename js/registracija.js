function konzola (){

        var ime=$("#tbIme").val();
        var prezime=$("#tbPrezime").val();
        var brtelefona = $("#brTelefona").val();
        var password=$("#password").val();
        var email=$("#email").val();

        var reIme=/^[A-ZĐŠŽĆČ][a-zđšžćč]{2,14}(\s[A-ZĐŠŽĆČ][a-zđšžćč]{2,14})?$/;
        var rePrezime=/^[A-ZĐŠŽĆČ][a-zđšžćč]{2,14}(\s[A-ZĐŠŽĆČ][a-zđšžćč]{2,14})?$/;
        var reBroj=/^[0-9]+$/;
        var rePassword=/^[A-z0-9]{8,}$/;
        var reEmail=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        var podaci=new Array();
        var greske=new Array();

        if(reIme.test(ime)){
            podaci.push(ime);
        }
        else {
            greske.push(ime);
            document.querySelector("#tbIme").style.border="1px solid red";
        }
        if(rePrezime.test(prezime)){
            podaci.push(prezime);
        }
        else {
            greske.push(prezime);
            document.querySelector("#tbPrezime").style.border="1px solid red";
        }
        if(reEmail.test(email)){
            podaci.push(ime);
        }
        else {
            greske.push(email);
            document.querySelector("#email").style.border="1px solid red";
        }
        if(rePassword.test(password)){
            podaci.push(password);
        }
        else {
            greske.push(password);
            document.querySelector("#password").style.border="1px solid red";
        }
    if (reBroj.test(brtelefona)){
        podaci.push(brtelefona);
        }
        else {
        greske.push(brtelefona);
        document.querySelector("#brTelefona").style.border="1px solid red";
        }
        if(greske.length>0) {
            document.querySelector("#dodatnoPoljeReg").innerHTML="Polja nisu dobro popunjena.";
        }
        else {
            $.ajax({
                url: "php/obrada.php",
                method: "POST",
                data: {
                    ime: ime,
                    prezime: prezime,
                    email: email,
                    brtelefona: brtelefona,
                    password: password,
                    btnReg:true
                },
                success: function (podaci) {
                    if (podaci == "") {
                        alert("Mail validacija nije potrebna jer ovaj free host ne podrzava mail() funciju.Zelimo Vam ugodan dan.Vas S'lux Zlatibor.")
                        document.querySelector("#dodatnoPoljeReg").innerHTML = "Uspešno ste se registrovali.";
                        document.querySelector("#dodatnoPoljeReg").style.color = "green";
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
                        alert("nema");
                    }
                    else {
                        alert("greska" + statuss + status);
                    }
                }

            });
        }

    }
// JavaScript source code
