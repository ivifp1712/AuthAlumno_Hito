function comprobar(valor) {
    //console.log("SUUU");
    var nombre = jQuery('#usuario').val();
    let request = $.ajax({
        url: "signup.php",
        type: "POST",
        data: pasar
})}