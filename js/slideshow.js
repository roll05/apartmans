


function rezervisi() {



    var idApartmana = $("#idApartmana").val();
    var idKorisnika = $("#idKorisnika").val();
    var datumOd = $("#datumOd").val();
    var datumDo = $("#datumDo").val();
    
    $.ajax({
        url: "php/rezervacija.php",
        method: "post",
        data: {
            idApartmana: idApartmana,
            idKorisnika: idKorisnika,
            datumDo: datumDo,
            datumOd: datumOd,
            dugme: true
        },
        success: function (podaci) {
            console.log(podaci);
            localStorage.removeItem('datumi');
            alert("Datumi su poslati da se provere.Javicemo Vam u sto kracem roku da li je apartman slobodan.Odgovor mozete da ocekujete na e-mail ili putem kontakt telefona koji ste ostavili u prijavi.Hvala na razumevanju i srdacan pozdrav.Vas S' Lux Zlatibor");
           location.replace("apartman.php?id=" + idApartmana);

        }



    })

   
}
function nemojRezervisati() {
    localStorage.removeItem('datumi');
    var idApartmana = $("#idApartmana").val();
    location.replace("apartman.php?id=" + idApartmana);

}