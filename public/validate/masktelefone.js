function telefone(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2");
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");
    return v;
}

function inteiro(v){
    v=v.replace(/\D/g,"");
    return v;
}

$(document).ready(function() {
            
    //Quando o campo cnpj perde o foco.
    $("#telefone").blur(function() {

        $(".campo-telefone label.alert-error").empty();
        $(".campo-telefone input").removeClass("alert-error");

        var telefone_val = inteiro($(this).val());

        if(telefone_val != ""){
            if(telefone_val.length >= 10){
                
                $("#telefone").val(telefone(telefone_val));

            }else{
                $('.campo-telefone label.alert-error').append('Telefone celular inválido').show();
                $('.campo-telefone input').addClass("alert-error");
            }
        }

    });
});