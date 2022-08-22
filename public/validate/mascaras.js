$(document).ready(function($) {
    $("#phone").mask("(99) 9999-9999");

    $("#celular").mask("(99) 9999-9999?9");
    
    $("#phoneresponsavel").mask("(99) 9999-9999?9");

    //$("#cnpj").mask("99.999.999/9999-99");

    $("#cpf").mask("999.999.999-99");

    $("#rg").mask("99.999.999? -*");

    $("#cep").mask("99999-999");

    $("#date").mask("99/99/9999");

    $("#valor").maskMoney({
        symbol: '',
        showSymbol: true,
        thousands: '',
        decimal: '.',
        symbolStay: true}
    );

    $("#valor_desconto").maskMoney({
        symbol: '',
        showSymbol: true,
        thousands: '',
        decimal: '.',
        symbolStay: true}
    );

    $("#valor_comissao").maskMoney({
        symbol: '',
        showSymbol: true,
        thousands: '',
        decimal: '.',
        symbolStay: true}
    );
});

//mascara para valores
function mascara(o,f){
	v_obj=o;
	v_fun=f;
	setTimeout("execmascara()",1);
}
function execmascara(){
	v_obj.value=v_fun(v_obj.value);
}
function mreais(v){
	v=v.replace(/\D/g,"");			//Remove tudo o que não é dígito
	v=v.replace(/(\d{2})$/,".$1");  //Coloca a virgula
	return v;
}

function nome(v){
	return v;
}

function nascimento(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       //Coloca um ponto entre o terceiro e o quarto dígitos
    return v;
}

function data_compra(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       //Coloca um ponto entre o terceiro e o quarto dígitos
    return v;
}

function data(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       //Coloca um ponto entre o terceiro e o quarto dígitos
    return v;
}

function cep(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{5})(\d)/,"$1-$2");       //Coloca um travessao entre o terceiro e o quarto dígitos
    return v;
}

function cnpj(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1.$2");       //Coloca um travessao entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2");       //Coloca um travessao entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1/$2");       //Coloca um travessao entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2");       //Coloca um travessao entre o terceiro e o quarto dígitos
    return v;
}

function inteiro(v){
    v=v.replace(/\D/g,"");          //Remove tudo o que não é dígito
    return v;
}

$(document).ready(function() {
            
    //Quando o campo cnpj perde o foco.
    $("#val_cnpj").blur(function() {

        $('.campo-cnpj label.alert-error').empty();
        $(".campo-cnpj input").removeClass("alert-error");

        var cnpj_val = inteiro($(this).val());

        if (cnpj_val != "") {

            $.ajax({
                url: site_url + 'empresa/busca_cnpj/'+cnpj_val,
                type: 'POST',
                async: 'false',
                data: {'cnpj':cnpj_val},
                success: function(dados) {

                    if(dados == '"FALSE"'){
                        
                        cnpj_val = cnpj(cnpj_val);
                        $("#val_cnpj").val(cnpj_val);

                        $('.campo-cnpj label.alert-error').append('CNPJ já cadastrado!').show();
                        $('.campo-cnpj input').addClass("alert-error");

                    }else if(dados == '"TRUE"'){
                        
                        cnpj_val = cnpj(cnpj_val);
                        $("#val_cnpj").val(cnpj_val);

                    }else{
                        
                        cnpj_val = cnpj(cnpj_val);
                        $("#val_cnpj").val(cnpj_val);

                        $('.campo-cnpj label.alert-error').append(dados).show();
                        $('.campo-cnpj input').addClass("alert-error");
                        
                    }

                }
            });

        }
    });
});