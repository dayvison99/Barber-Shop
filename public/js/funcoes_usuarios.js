$(document).ready(function($) {

	$('#form_usuario').validate({
		rules: {
			nome: {
				required: true
			},
			usuario: {
				required: true
			},
			tipo_usuario: {
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
            rep_senha: {
                equalTo: "As senhas devem ser iguais."
            }
        }
	});

});