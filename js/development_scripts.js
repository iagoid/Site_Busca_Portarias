$(document).ready(function() {

    var input_check = $("#access_terms")
    var btn_access = $('#btn-access')

    input_check.on('click',function(){
        console.log("aaaaaaaaaaa")
        if( $("#access_terms").is(":checked") == true ){
            btn_access.prop("disabled", false);
            btn_access.html('Participar do experimento');

        }
        else{
            $('#btn-access').prop("disabled", true);
            btn_access.html('Aceite os termos para continuar');
        }
    })

})