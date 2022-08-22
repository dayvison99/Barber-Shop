$(document).ready(function($) {

    $('#formCadastro').validate({
        rules: {
            razao_social: {
                required: true
            },
            nome: {
                required: true
            },
            /*cnpj: {
                required: true,
                cnpj: 'both'
            },*/
            cpf: {
                required: true,
                cpf: 'both'
            },
            email: {
                required: true
            },
            senha: {
                required: true,
                minlength: 6
            },
            rep_senha: {
                required: true,
                equalTo: "#senha"
            }
        },
        messages: {
            cnpj: {
                maxlength: ""
            },
            cpf: {
                cpf: "O CPF digitado é inválido"
            },
            rep_senha: {
                equalTo: "As senhas devem ser iguais."
            }
            
        }
    });

});
