function excluir_imagem(pasta, id, imagem, tabela ,value, campo){
	$("#mensagem_retorno .dado_msg").empty();
	if (confirm('Deseja realmente deletar este registro?')) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/excluir_imagem.php',
			async: true,
			data: {"pasta": pasta, "id": id, "imagem": imagem, "tabela":tabela ,"value": value, "campo" : campo},
			success: function(response) {
				try {
					if(response.return){
						window.location.reload()
					}else{
						alert('Ocorreu um erro');
						console.log(response);
					}
				} catch(err) {
					alert('Ocorreu um erro');
					console.log(response);
				}
			},
			error: function(xhr, status, error){
				alert('Ocorreu um erro');
				console.log(xhr);
				console.log(status);
				console.log(error);
			}
		});
	}
}