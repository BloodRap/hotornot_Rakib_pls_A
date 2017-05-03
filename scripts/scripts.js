$(document).ready(function(){

    $("#admin").click(function () { // function för att visa form för admins inloggning
        $("#admin").css("display", "none");
        $("#form").css("display", "block");
    });

    $("#selectImage").click(function () { // triggas klick på hidden input för att välja bild
        $("#hide").trigger('click');
    });

    $("#pass").keyup(function(e){ // ESC knappen stänger döljer admin inloggnings form
        if (e.keyCode == 27) {
        $("#form").css("display", "none");
        $("#admin").css("display", "block");
        }
    });
});
