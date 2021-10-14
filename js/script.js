$(document).ready(function () {
    $(".title h1").delay(500);
    $(".title h1").animate({ fontSize: "3rem", margin: "5" }, 2000);


    $(".links a").hover(function () {
        $(this).animate({ fontSize: "3rem" }, 300);
    }, function () {
            $(this).animate({ fontSize: "2rem" }, 300);

    });

});


