function prijava() {

    var email = $("#emailLog").val();
    var password = $("#passwordLog").val();

    var errors = new Array();

    var reEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var rePassword = /^[A-z0-9]{8,}$/;

    if (!reEmail.test(email)) {
        errors.push("Ne postoji korisnik sa ovom e-mail adresom");
        document.querySelector("#emailLog").style.border = "1px solid red";
    }
    if (!rePassword.test(password)) {
        errors.push("Ne postoji korisnik sa ovom e-mail adresom");
        document.querySelector("#passwordLog").style.border = "1px solid red";
    }

    if (errors.length != 0) {
        document.querySelector("#dodatnoPolje").innerHTML = "Ne postoji korisnik sa ovim parametrima.";
    } else {
        $.ajax({
            url: "php/login.php",
            method: "POST",
            data:{
                email: email,
                password: password,
                btnLog: true
            },
            success: function (podaci) {
                if (podaci == "") {
                    localStorage.removeItem('datumi');
                    window.location = "index.php";
                }
                else {
                    localStorage.removeItem('datumi');
                    alert(podaci);
                    window.location = "index.php";
                }

            },
            error: function (xhr, statuss) {
                let status = xhr.status;
                if (status == 500) {
                    alert("Problem prilikom logovanja");
                } else if (status == 400) {
                    alert("Nisu dobro uneti parametri");
                }
                else {
                    window.location.href="index.php";
                    alert("greska" + statuss + status);
                }
            }

        })
    }
}
