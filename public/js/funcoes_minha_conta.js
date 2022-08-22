$(document).ready(function($) {

	$('#form_minha_conta').validate({
		rules: {
			senha_atual: {
				required: true
			},
			nova_senha: {
				required: true,
				minlength: 6
			},
			conf_senha: {
				required: true,
				equalTo: "#nova_senha"
			}
		},
		messages: {
			conf_senha: {
				equalTo: "As senhas devem ser iguais."
			}
		}
	});

});

function salva_dados(){
	$("#mensagem_minha_conta .dado_msg").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/minha_conta_cadastro.php',
		async: true,
		data: {"nome": $("#nome").val(), "nova_senha": $("#nova_senha").val(), "senha_atual" : $("#senha_atual").val() , "id" : $("#id").val()},
		success: function(response) {
			// console.log(response);
			try {
				if(response.return){
					if (confirm('Dados alterados com sucesso, realize o login novamente!')) {
						window.location = base_url + '/content/class/logout.php';
					}else{
						window.location = base_url + '/content/class/logout.php';
					}
				}else{
					$("#mensagem_minha_conta").addClass("alert-error").show();
					$("#mensagem_minha_conta p.dado_msg").append(response.msg);
					// alert('Ocorreu um erro');
					console.log(response.msg);
					// window.location.href = tabela+'&status=success&msg='+response.msg;
				}

				loadingHide();
			} catch(err) {
				alert('Ocorreu um erro');
				console.log(response);
				loadingHide();
			}
		},
		error: function(xhr, status, error){
			alert('Ocorreu um erro');
			console.log(xhr);
			console.log(status);
			console.log(error);
			loadingHide();
		}
	});
}