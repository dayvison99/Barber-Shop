$(document).ready(function () {
   $('input').keypress(function (e) {
		var code = null;
		code = (e.keyCode ? e.keyCode : e.which);                
		return (code == 13) ? false : true;
   });

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

function nome(v){
	return v;
}

function telefone(v){
	v=v.replace(/\D/g,"");

	if(v.substring(0,4) == '0800'){
		
		v=v.replace(/^(\d{4})(\d)/g,"$1 $2");
		v=v.replace(/(\d)(\d{4})$/,"$1 $2");

	}else if(v.length <= 10){
		v=v.replace(/(\d{2})(\d)/,"($1) $2");
		v=v.replace(/(\d{4})(\d)/,"$1-$2");

	}else if(v.length >= 11){
		v=v.replace(/(\d{2})(\d)/,"($1) $2");
		v=v.replace(/(\d{5})(\d)/,"$1-$2");
	}
	return v;
}

function money(v) {
	v = v.replace(/\D/g,"");
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	return v;
}

function deleta(tabela, id, id_secundario=0){
	$("#mensagem_retorno .dado_msg").empty();
	loadingShow();
	if (confirm('Deseja realmente deletar este registro?')) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/deleta_dado.php',
			async: true,
			data: {"tabela": tabela, "id": id},
			success: function(response) {
				try {
					if(response.return){
							$("#mensagem_retorno").addClass("alert-success").show();
							$("#mensagem_retorno p.dado_msg").append("Dado excluído com sucesso!");

						if(id_secundario == 0){
							$("#dado_lista"+id).hide();
						}else{
							$("#dado_lista"+id_secundario).hide();
						}
						// console.log(response.msg);
						// window.location.href = tabela+'&status=success&msg='+response.msg;
					}else{
						$("#mensagem_retorno").addClass("alert-success").show();
						$("#mensagem_retorno p.dado_msg").append("Houve algum erro ao excluir!");
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
	}else{
		loadingHide();
	}
}

function deletaImagem(pasta, imagem, id){
	$("#mensagem_retorno .dado_msg").empty();
	loadingShow();
	if (confirm('Deseja realmente deletar este registro?')) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/excluir_imagem.php',
			async: true,
			data: {"pasta": pasta, "imagem": imagem},
			success: function(response) {
				try {
					if(response.return){
						$("#mensagem_retorno").addClass("alert-success").show();
						$("#mensagem_retorno p.dado_msg").append("Imagem excluida com sucesso!");
						$("#dado_lista"+id).hide();
						// console.log(response.msg);
					}else{
						$("#mensagem_retorno").addClass("alert-success").show();
						$("#mensagem_retorno p.dado_msg").append("Houve algum erro ao excluir!");
						// alert('Ocorreu um erro');
						console.log(response.msg);
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
	}else{
		loadingHide();
	}
}

function status(tabela, id){
	var status = $("#dado_lista"+id+" #value_status").text();

	$("#dado_lista"+id+" #value_status").empty();
	$("#mensagem_retorno .dado_msg").empty();

	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/alterar_status.php',
		async: true,
		data: {"tabela": tabela, "id": id},
		success: function(response) {
			try {
				if(response.return){
					$("#mensagem_retorno").addClass("alert-success").show();
					$("#mensagem_retorno p.dado_msg").append("Status alterado com sucesso!");
					
					if(status == 1){
						$("#dado_lista"+id+" .label_status small.label").removeClass('label-success').addClass('label-warning');
						$("#dado_lista"+id+" .label_status small.label").empty().append("Inativo");

						$("#dado_lista"+id+" a.link_status").removeClass('text-yellow').addClass('text-green');
						$("#dado_lista"+id+" a.link_status").empty().append("<i class='fa fa-check-circle-o'></i> Ativar");
						
						// $("#dado_lista"+id+" #value_status").empty();
						$("#dado_lista"+id+" #value_status").append("0");
					}else{
						$("#dado_lista"+id+" .label_status small.label").removeClass('label-warning').addClass('label-success');
						$("#dado_lista"+id+" .label_status small.label").empty().append("Ativo");

						$("#dado_lista"+id+" a.link_status").removeClass('text-green').addClass('text-yellow');
						$("#dado_lista"+id+" a.link_status").empty().append("<i class='fa fa-check-circle-o'></i> Desativar");
						
						// $("#dado_lista"+id+" #value_status").empty();
						$("#dado_lista"+id+" #value_status").append("1");
					}
				}else{
					$("#mensagem_retorno").addClass("alert-warning").show();
					$("#mensagem_retorno p.dado_msg").append("Houve um erro ao alterar o status!");
					// alert('Ocorreu um erro');
					console.log(response.msg); 
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

function edita(tabela, value, id, campo){
	$("#mensagem_retorno .dado_msg").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/edita_dado.php',
		async: true,
		data: {"tabela": tabela, "value": value, "id": id, "campo" : campo},
		success: function(response) {
			try {
				if(response.return){
					$("#mensagem_retorno").addClass("alert-success").show();
					$("#mensagem_retorno p.dado_msg").append("Dado alterado com sucesso!");
				}else{
					$("#mensagem_retorno").addClass("alert-success").show();
					$("#mensagem_retorno p.dado_msg").append("Houve algum erro ao alterar!");
					// alert('Ocorreu um erro');
					console.log(response.msg);
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

function ativa(tabela, value, id, campo){
	$("#mensagem_retorno .dado_msg").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/edita_dado_ativa.php',
		async: true,
		data: {"tabela": tabela, "value": value, "id": id, "campo" : campo},
		success: function(response) {
			try {
				if(response.return){
					// $("#mensagem_retorno").addClass("alert-success").show();
					// $("#mensagem_retorno p.dado_msg").append("Dado alterado com sucesso!");
				}else{
					// $("#mensagem_retorno").addClass("alert-success").show();
					// $("#mensagem_retorno p.dado_msg").append("Houve algum erro ao alterar!");
					// alert('Ocorreu um erro');
					alert('Ocorreu um erro');
					console.log(response.msg);
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

function exibeCampo(){
	$(".exibe_campos").toggle();
}

function formatReal( value ){
		var val = value.toLocaleString('pt-br', {minimumFractionDigits: 2, maximumFractionDigits: 2});
		return val;
}

function abrirLoja(val){
	loadingShow();
	var text = '';

	if(val == 1){
		text = "Deseja realmente ABRIR a loja?";
	}else{
		text = "Deseja realmente FECHAR a loja?"
	}
	if (confirm(text)) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/edita_dado_ativa.php',
			async: true,
			data: {"tabela": "setup", "value": '', "id": "1", "campo" : "status_loja"},
			success: function(response) {
				try {
					// if(response.return){
					// 	if(val == 1){
					// 		$("#abre_loja a").empty();
					// 		$("#abre_loja a").append('<i class="fa fa-circle text-success"></i> <span>Loja Aberta <small>(Fechar Loja)</small></span>');
					// 		$("#abre_loja a").attr('onclick','abrirLoja(0)');
					// 	}else{
					// 		$("#abre_loja a").empty();
					// 		$("#abre_loja a").append('<i class="fa fa-circle text-danger"></i> <span>Loja Fechada <small>(Abrir Loja)</small></span></span>');
					// 		$("#abre_loja a").attr('onclick','abrirLoja(1)');
					// 	}
					// 	// $("#mensagem_retorno p.dado_msg").append("Dado alterado com sucesso!");
					// }else{
					// 	// $("#mensagem_retorno").addClass("alert-success").show();
					// 	// $("#mensagem_retorno p.dado_msg").append("Houve algum erro ao alterar!");
					// 	// alert('Ocorreu um erro');
					// 	alert('Ocorreu um erro');
					// 	console.log(response.msg);
					// }

					location.reload();

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
	}else{
		loadingHide();
	}
}

$(document).ready(function(){
function fecharLoja(){
	alert('oi');
	// $.ajax({
	// 	type: 'POST',
	// 	dataType: 'json',
	// 	url: base_url + '/content/class/edita_dado_ativa.php',
	// 	async: true,
	// 	data: {"tabela": "setup", "value": '', "id": "1", "campo" : "status_loja"},
	// 	success: function(response) {
	// 		try {
	// 			location.reload();
	// 		} catch(err) {
	// 			alert('Ocorreu um erro');
	// 			console.log(response);
	// 		}
	// 	},
	// 	error: function(xhr, status, error){
	// 		alert('Ocorreu um erro');
	// 		console.log(xhr);
	// 		console.log(status);
	// 		console.log(error);
	// 		loadingHide();
	// 	}
	// });
	
}
});

function campo_unico(value, campo, tabela){
	$("#mensagem_retorno .dado_msg").empty();
	loadingShow();
	$("#valida-campo").html("");
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/campo_unico.php',
		async: true,
		data: {"value": value, "campo": campo, "tabela": tabela},
		success: function(response) {

			// console.log(response);
			try {
				if(response.return){
					$(".class-button-validate").attr('disabled', 'disabled');
					$("#valida-campo").show();
					$("#valida-campo").append("Valor já cadastrado, informe outro valor");
				}else{
					$("#valida-campo").hide();
					$(".class-button-validate").removeAttr('disabled');
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