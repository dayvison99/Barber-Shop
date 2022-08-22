function altera_status(id, status, nome_cliente, email_cliente){
	$("#mensagem_retorno .dado_msg").empty();
	loadingShow();
	if (confirm('Deseja realmente alterar o status?')) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/pedidos_status_edita.php',
			async: true,
			data: {"id": id, "status": status, "nome_cliente":nome_cliente, "email_cliente":email_cliente},
			success: function(response) {
				// console.log(response);
				try {
					if(response.return){

						var html = '';
						$("#dado_lista"+id+" .pedido_novo").remove();
						if(status == 2){
							$("#dado_lista"+id+" .label_status .label").removeClass("label-default");
							$("#dado_lista"+id+" .label_status .label").addClass("label-info");

							html += 'Pedido Impresso';
						}else if(status == 3){
							$("#dado_lista"+id+" .label_status .label").removeClass("label-info");
							$("#dado_lista"+id+" .label_status .label").addClass("label-primary");

							html += 'Saiu para Entrega';
						}else if(status == 4){
							$("#dado_lista"+id+" .label_status .label").removeClass("label-primary");
							$("#dado_lista"+id+" .label_status .label").addClass("label-success");

							html += 'Pedido Entregue';
						}else if(status == 5){
							$("#dado_lista"+id+" .label_status .label").removeClass("label-primary");
							$("#dado_lista"+id+" .label_status .label").removeClass("label-default");
							$("#dado_lista"+id+" .label_status .label").removeClass("label-info");
							$("#dado_lista"+id+" .label_status .label").removeClass("label-success");
							$("#dado_lista"+id+" .label_status .label").addClass("label-danger");

							html += 'Cancelado';
						}
						
						$("#dado_lista"+id+" .label_status li.status"+status).remove();

						$("#dado_lista"+id+" .label_status .label").empty();
						$("#dado_lista"+id+" .label_status .label").append(html);

						$("#mensagem_retorno").addClass("alert-success").show();
						$("#mensagem_retorno p.dado_msg").append("Status do pedido alterado com sucesso!");

						// console.log(response.msg);
						// window.location.href = tabela+'&status=success&msg='+response.msg;
					}else{
						$("#mensagem_retorno").addClass("alert-success").show();
						$("#mensagem_retorno p.dado_msg").append("Houve algum erro ao alterar o status do pedido!");
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

function cancela_pedido(tabela, id){
	$("#mensagem_retorno .dado_msg").empty();
	loadingShow();
	if (confirm('Deseja realmente cancelar o pedido?')) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/pedidos_cancela.php',
			async: true,
			data: {"tabela": tabela, "id": id},
			success: function(response) {
				try {
					if(response.return){
						$("#mensagem_retorno").addClass("alert-success").show();
						$("#mensagem_retorno p.dado_msg").append("Pedido cancelado com sucesso!");

						$("#dado_lista"+id+" .label_status").empty();
						$("#dado_lista"+id+" .label_status").append("<small class='label label-danger'>Cancelado</small>");
						$("#dado_lista"+id+" .cancela_pedido").hide();
						// console.log(response.msg);
						// window.location.href = tabela+'&status=success&msg='+response.msg;
					}else{
						$("#mensagem_retorno").addClass("alert-success").show();
						$("#mensagem_retorno p.dado_msg").append("Houve algum erro ao cancelar o pedido!");
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

function altera_status_imprime(id, status, nome_cliente, email_cliente){
	$("#mensagem_retorno .dado_msg").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/pedidos_status_edita.php',
		async: true,
		data: {"id": id, "status": status, "nome_cliente":nome_cliente, "email_cliente":email_cliente},
		success: function(response) {
			// console.log(response);
			try {
				if(response.return){

					var html = '';
					if(status == 2){

						if(response.status_pedido == 1){

							$("#dado_lista"+id+" .label_status .label").removeClass("label-default");
							$("#dado_lista"+id+" .label_status .label").addClass("label-info");

							$("#dado_lista"+id+" .label_status li.status"+status).remove();
							$("#dado_lista"+id+" .pedido_novo").remove();

							$("#dado_lista"+id+" .label_status .label").empty();
							$("#dado_lista"+id+" .label_status .label").append('Pedido Impresso');

							$("#mensagem_retorno").addClass("alert-success").show();
							$("#mensagem_retorno p.dado_msg").append("Status do pedido alterado com sucesso!");
						}

					}
					
					// console.log(response.msg);
					// window.location.href = tabela+'&status=success&msg='+response.msg;
				}else{
					$("#mensagem_retorno").addClass("alert-success").show();
					$("#mensagem_retorno p.dado_msg").append("Houve algum erro ao alterar o status do pedido!");
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