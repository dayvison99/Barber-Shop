$(document).ready( function() {
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {
		
		var input = $(this).parents('.input-group').find(':text'),
			log = label;
		
		if( input.length ) {
			input.val(log);
		} else {
			if( log ) alert(log);
		}
	
	});

	function readCat(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			// reader.onload = function (e) {
			// 	$("#example1 tbody").append("");
			//     $('#img-upload').attr('src', e.target.result);
			// }
			reader.readAsDataURL(input.files[0]);
			readImgCategoria(input.files[0]);
		}
	}
	
	function readIco(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			// reader.onload = function (e) {
			// 	$("#example1 tbody").append("");
			//     $('#img-upload').attr('src', e.target.result);
			// }
			reader.readAsDataURL(input.files[0]);
			readIcoMenu(input.files[0]);
		}
	}

	$("#imgCat").change(function(){
		// loadingShow();
		readCat(this);
	});

	$("#imgIco").change(function(){
		// loadingShow();
		readIco(this);
	});

});

function readImgCategoria(file, srcImage) {

	var form = new FormData();
	form.append('imagem', file);
	$("#mensagem_imagem p.dado_msg").empty();

	$.ajax({
		url: base_url + '/content/class/categoria_imagem_cadastro.php',
		type: "POST",
		cache: false,
		contentType: false,
		processData: false,
		async: true,
		data : form,
		dataType: 'json',
		success: function(response) {
			// console.log(response);
			try {
				if(response.return){

					var html = "";

					html += '<img src="'+path_upload+'categorias/'+response.imagem+'" width="100" >';
					html += '<input type="hidden" value="'+response.imagem+'" name="imagem_categoria">';
					html += '<a href="javascript:void(0)" class="text-red" id="excluirImagem" style="margin-left: 10px" onclick="deleta_imagem(1);"><i class="fa fa-times"></i> excluir</a>';

					$("#categoria_insert").hide();
					$("#categoria_image").append(html).show();

				}else{
					$("#mensagem_imagem").addClass("alert-warning").show();
					$("#mensagem_imagem p.dado_msg").append("Houve algum erro ao cadastrar a imagem: <br />" + response.msg );
					// alert('Ocorreu um erro');
					// console.log(response.msg);
				}

				loadingHide();
			} catch(err) {
				$("#mensagem_imagem").addClass("alert-warning").show();
				$("#mensagem_imagem p.dado_msg").append("Houve algum erro ao cadastrar a imagem: <br />" + response.msg );
				// alert('Ocorreu um erro');
				// console.log(response.msg);
				loadingHide();
			}
		},
		error: function(xhr, status, error){
			alert('Ocorreu um erro!');
			console.log(xhr);
			console.log(status);
			console.log(error);
			loadingHide();
		}
	});
}

function readIcoMenu(file, srcImage) {

	var form = new FormData();
	form.append('imagem', file);
	$("#mensagem_imagem p.dado_msg").empty();

	$.ajax({
		url: base_url + '/content/class/categoria_imagem_cadastro.php',
		type: "POST",
		cache: false,
		contentType: false,
		processData: false,
		async: true,
		data : form,
		dataType: 'json',
		success: function(response) {
			// console.log(response);
			try {
				if(response.return){

					var html = "";

					html += '<img src="'+path_upload+'categorias/'+response.imagem+'" width="100" >';
					html += '<input type="hidden" value="'+response.imagem+'" name="icone_categoria">';
					html += '<a href="javascript:void(0)" class="text-red" id="excluirIconeMenu" style="margin-left: 10px" onclick="deleta_imagem(0);"><i class="fa fa-times"></i> excluir</a>';

					$("#icone_insert").hide();
					$("#icone_image").append(html).show();

				}else{
					$("#mensagem_imagem").addClass("alert-warning").show();
					$("#mensagem_imagem p.dado_msg").append("Houve algum erro ao cadastrar a imagem: <br />" + response.msg );
					// alert('Ocorreu um erro');
					// console.log(response.msg);
				}

				loadingHide();
			} catch(err) {
				$("#mensagem_imagem").addClass("alert-warning").show();
				$("#mensagem_imagem p.dado_msg").append("Houve algum erro ao cadastrar a imagem: <br />" + response.msg );
				// alert('Ocorreu um erro');
				// console.log(response.msg);
				loadingHide();
			}
		},
		error: function(xhr, status, error){
			alert('Ocorreu um erro!');
			console.log(xhr);
			console.log(status);
			console.log(error);
			loadingHide();
		}
	});
}

function deleta_imagem(type=0){
	loadingShow();
	if(type == 0){
		$("#icone_insert").show();
		$("#icone_image").hide();

		$("#icone_image input").remove();
		$("#img_icone_categoria").remove();
	}else if(type == 1){
		$("#categoria_insert").show();
		$("#categoria_image").hide();

		$("#categoria_image input").remove();
		$("#iamgem_categoria").remove();
	}
	loadingHide();
}


function deleta_imagem_edita(type=0,id){
	loadingShow();
	if(type == 0){

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/categorias_imagem_deleta.php',
			async: true,
			data: {"id": id, "campo": "icone_menu"},
			success: function(response) {

				try {
					if(response.return){

						$("#icone_insert").show();
						$("#icone_image").hide();

						$("#icone_image input").remove();
						$("#img_icone_categoria").remove();

					}else{
						// $("#mensagem_categoria").addClass("alert-warning").show();
						// $("#mensagem_categoria p.dado_msg").append("Ocorreu um erro ao buscar o produto!");
						// alert('Ocorreu um erro');
						console.log(response.return);
						// window.location.href = retorno+'&tela=atributos';
					}

					loadingHide();
				} catch(err) {
					alert('Ocorreu um erro');
					console.log(response);
					loadingHide();
				}
				loadingHide();
			},
			error: function(xhr, status, error){
				alert('Ocorreu um erro');
				console.log(xhr);
				console.log(status);
				console.log(error);
				loadingHide();
			}
		});

	}else if(type == 1){
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/categorias_imagem_deleta.php',
			async: true,
			data: {"id": id, "campo": "imagem"},
			success: function(response) {

				try {
					if(response.return){

						$("#categoria_insert").show();
						$("#categoria_image").hide();

						$("#categoria_image input").remove();
						$("#iamgem_categoria").remove();

					}else{
						// $("#mensagem_categoria").addClass("alert-warning").show();
						// $("#mensagem_categoria p.dado_msg").append("Ocorreu um erro ao buscar o produto!");
						// alert('Ocorreu um erro');
						console.log(response.return);
						// window.location.href = retorno+'&tela=atributos';
					}

					loadingHide();
				} catch(err) {
					alert('Ocorreu um erro');
					console.log(response);
					loadingHide();
				}
				loadingHide();
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
	loadingHide();
}

function busca_categorias(){

	$("#mensagem_categoria p.dado_msg").empty();
	$("#lista_categorias").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/categorias_busca.php',
		async: true,
		data: {"value": $("#busca_categoria").val()},
		success: function(response) {

			// console.log(response);

			try {
				if(response.return){

					var html = '';
					html += '<h4>Resultado da busca: <strong>'+$("#busca_categoria").val()+'</strong></h4>';

					$.each( response.dados, function( key, value ) {

						html += '<div class="form-group col-sm-4">';
						html += '<div class="checkbox">';
						html += '<label>';
						html += '<input type="checkbox" value="'+value.id+'" id="check_categoria'+value.id+'" class="seleciona_categoria" onchange="add_categoria('+value.id+',\''+value.nome+'\')">';
						html += value.nome;
						html += '</label>';
						html += '</div>';
						html += '</div>';
					});
					html += '<div style="clear: both"></div><hr>';
					$("#lista_categorias").append(html);

				}else{
					$("#mensagem_categoria").addClass("alert-warning").show();
					$("#mensagem_categoria p.dado_msg").append("Ocorreu um erro ao buscar o produto!");
					// alert('Ocorreu um erro');
					console.log(response.return);
					// window.location.href = retorno+'&tela=atributos';
				}

				loadingHide();
			} catch(err) {
				alert('Ocorreu um erro');
				console.log(response);
				loadingHide();
			}
			loadingHide();
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

function add_categoria(id, nome){

	loadingShow();

	$("#check_categoria"+id).attr('disabled','disabled');

	var html = '';
	html    += '<tr id="categoria'+id+'">';
	html    += '<td>'+id+'</td>';
	html    += '<td>'+nome;
	html    += '<input type="hidden" name="subcategoria[]" value="'+id+'">';
	html    += '</td>';
	html    += '<td><a href="javascript:void(0);" class="text-yellow link_status" onclick="categoria_excluir_novo('+id+');"><i class="fa fa-times"></i> excluir</a></td>';
	html    += '</tr>';

	$("#table_categorias tbody").append(html);

	$("#lista_categorias_table").show();

	loadingHide();

}

function adiciona_categoria_edita(){

	loadingShow();

	var nome         = $("#nome_subcategoria").val(),
		qtDiv        = $("#table_categorias tbody tr").length + 1,
		id_categoria = $("#id_categoria").val(),
		html         = '';

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/categorias_sub_cadastro.php',
		async: true,
		data: {"nome_sub_categoria": nome, "id_categoria": id_categoria},
		success: function(response) {

			try {
				if(response.return){

					html += '<tr id="dado_lista'+response.id+'">';
					html += '<td>'+qtDiv+'</td>';
					html += '<td>';
					html += '<input type="text" name="nome_sub_categoria" value="'+nome+'" style="width: 100%; " onblur="edita_nome(\'categorias_sub\',$(this).val(),'+response.id+')">';
					html += '</td>';
					html += '<td>';
					html += '<input type="number" name="subcategoriaordem[]" value="0" style="width:100%; text-align:center" onblur="edita_ordem(\'categorias_sub\',$(this).val(),'+response.id+')">';
					html += '</td>';
					html += '<td><a href="javascript:void(0);" class="text-yellow link_status" onclick="deleta(\'categorias_sub\', '+response.id+');"><i class="fa fa-times"></i> excluir</a></td>';
					html += '</tr>';

					$("#table_categorias tbody").append(html);

					$("#lista_categorias_table").show();

					$("#nome_subcategoria").val("");

				}else{
					$("#mensagem_categoria").addClass("alert-warning").show();
					$("#mensagem_categoria p.dado_msg").append("Ocorreu um erro ao buscar o produto!");
					// alert('Ocorreu um erro');
					console.log(response.return);
					// window.location.href = retorno+'&tela=atributos';
				}

				loadingHide();
			} catch(err) {
				alert('Ocorreu um erro');
				console.log(response);
				loadingHide();
			}
			loadingHide();
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

function adiciona_categoria(){

	loadingShow();

	var nome  = $("#nome_subcategoria").val(),
		qtDiv = $("#table_categorias tbody tr").length + 1,
		html  = '';

	html += '<tr id="subcategoria'+qtDiv+'">';
	html += '<td>'+qtDiv+'</td>';
	html += '<td>'+nome;
	html += '<input type="hidden" name="subcategoria[]" value="'+nome+'">';
	html += '</td>';
	html += '<td>';
	html += '<input type="number" name="subcategoriaordem[]" value="0" style="width:100%; text-align:center" >';
	html += '</td>';
	html += '<td><a href="javascript:void(0);" class="text-yellow link_status" onclick="categoria_excluir_novo('+qtDiv+');"><i class="fa fa-times"></i> excluir</a></td>';
	html += '</tr>';

	$("#table_categorias tbody").append(html);

	$("#lista_categorias_table").show();

	$("#nome_subcategoria").empty();

	loadingHide();

}

function categoria_excluir_novo(id){
	
	loadingShow();

	// $("#check_categoria"+id).removeAttr('disabled');
	// $("#check_categoria"+id).prop('checked', false);

	$("#subcategoria"+id).remove();

	loadingHide();
}

function categoria_excluir(id,id_subcategoria){
	$("#mensagem_categoria p.dado_msg").empty();
	loadingShow();
	if (confirm('Deseja realmente deletar este registro?')) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: base_url + '/content/class/categorias_sub_deleta.php',
			async: true,
			data: {"id": id},
			success: function(response) {

				try {
					if(response.return){

						$("#mensagem_categoria").addClass("alert-success").show();
						$("#mensagem_categoria p.dado_msg").append("subcategoria excluido com sucesso!");

						$("#categoria"+id_subcategoria).hide();

					}else{
						$("#mensagem_categoria").addClass("alert-warning").show();
						$("#mensagem_categoria p.dado_msg").append("Ocorreu um erro ao excluir!");
						// alert('Ocorreu um erro');
						console.log(response.return);
						// window.location.href = retorno+'&tela=atributos';
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

function add_categoria_editar(id, categoria, nome){

	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/categorias_sub_cadastro.php',
		async: true,
		data: {"id": id, "categoria": categoria, "nome": nome},
		success: function(response) {

			// console.log(response);

			try {
				if(response.return){

					// console.log(response);

					$("#check_categoria"+id).attr('disabled','disabled');

					var html = '';
					html    += '<tr id="categoria'+id+'">';
					html    += '<td>'+id+'</td>';
					html    += '<td>'+nome+'</td>';
					html    += '<td><a href="javascript:void(0);" class="text-yellow link_status" onclick="categoria_excluir('+response.id+','+id+');"><i class="fa fa-times"></i> excluir</a></td>';
					html    += '</tr>';

					$("#table_categorias tbody").append(html);

					$("#lista_categorias_table").show();

				}else{
					$("#mensagem_categoria").addClass("alert-warning").show();
					$("#mensagem_categoria p.dado_msg").append("Ocorreu um erro ao buscar a categoria!");
					// alert('Ocorreu um erro');
					console.log(response);
					// window.location.href = retorno+'&tela=atributos';
				}

				loadingHide();
			} catch(err) {
				alert('Ocorreu um erro');
				// console.log(response);
				loadingHide();
			}
			loadingHide();
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

function busca_categoria_editar(){

	$("#mensagem_categoria p.dado_msg").empty();
	$("#lista_categorias").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/categorias_busca.php',
		async: true,
		data: {"value": $("#busca_categoria").val(), 'id_categotia': $("#id_categotia").val() },
		success: function(response) {

			// console.log(response);

			try {
				if(response.return){

					var html = '';
					html += '<h4>Resultado da busca: <strong>'+$("#busca_categoria").val()+'</strong></h4>';

					$.each( response.dados, function( key, value ) {

						html += '<div class="form-group col-sm-4">';
						html += '<div class="checkbox">';
						html += '<label>';

						if($("#categoria"+value.id).length > 0){

							html += '<input type="checkbox" value="'+value.id+'" id="check_categoria'+value.id+'" class="seleciona_categoria" onchange="add_categoria_editar('+value.id+','+$("#id_categoria").val()+',\''+value.nome+'\')" disabled="disabled" checked>';
						}else{

							html += '<input type="checkbox" value="'+value.id+'" id="check_categoria'+value.id+'" class="seleciona_categoria" onchange="add_categoria_editar('+value.id+','+$("#id_categoria").val()+',\''+value.nome+'\')">';
						}

						html += value.nome;
						html += '</label>';
						html += '</div>';
						html += '</div>';
					});
					html += '<div style="clear: both"></div><hr>';
					$("#lista_categorias").append(html);

				}else{
					$("#mensagem_categoria").addClass("alert-warning").show();
					$("#mensagem_categoria p.dado_msg").append("Ocorreu um erro ao buscar o produto!");
					// alert('Ocorreu um erro');
					console.log(response.return);
					// window.location.href = retorno+'&tela=atributos';
				}

				loadingHide();
			} catch(err) {
				alert('Ocorreu um erro');
				console.log(response);
				loadingHide();
			}
			loadingHide();
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

function edita_nome(tabela, value, id){
	$("#mensagem_subcategoria p.dado_msg").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/categoria_sub_edita_nome.php',
		async: true,
		data: {"tabela": tabela, "nome_sub_categoria": value, "id": id},
		success: function(response) {
			try {
				if(!response.return){
					$("#mensagem_subcategoria").addClass("alert-warning").show();
					$("#mensagem_subcategoria p.dado_msg").append("Houve um erro ao alterar o nome!");
					// alert('Ocorreu um erro');
					console.log(response.return);
					// window.location.href = tabela+'&tela=imagens';
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

function edita_ordem(tabela, value, id){
	$("#mensagem_subcategoria p.dado_msg").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/categoria_sub_edita_ordem.php',
		async: true,
		data: {"tabela": tabela, "ordem": value, "id": id},
		success: function(response) {
			try {
				if(!response.return){
					$("#mensagem_subcategoria").addClass("alert-warning").show();
					$("#mensagem_subcategoria p.dado_msg").append("Houve um erro ao alterar a ordem!");
					// alert('Ocorreu um erro');
					console.log(response.return);
					// window.location.href = tabela+'&tela=imagens';
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

function busca_produto(){

	$("#mensagem_produto p.dado_msg").empty();
	$("#dados_produtos").empty();
	loadingShow();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/produtos_busca.php',
		async: true,
		data: {"value": $("#busca_produto").val()},
		success: function(response) {

			// console.log(response);

			try {
				if(response.return){

					var html = '';
					html += '<h4>Resultado da busca: <strong>'+$("#busca_produto").val()+'</strong></h4>';

					$.each( response.dados, function( key, value ) {
						// console.log(value);
						nome = value.nome.replace("'","⁹")
						html += '<div class="form-group col-sm-4">';
						html += '<div class="checkbox">';
						html += '<label>';
						html += '<input type="checkbox" value="'+value.id+'" id="check_produto'+value.id+'" onchange="add_produto('+value.id+',\''+nome+'\')" name="check_produto">';
						html += value.nome;
						html += '</label>';
						html += '</div>';
						html += '</div>';
					});
					
					html += '<div style="clear: both"></div><hr>';

					$("#dados_produtos").append(html);

				}else{
					$("#mensagem_produto").addClass("alert-warning").show();
					$("#mensagem_produto p.dado_msg").append("Ocorreu um erro ao buscar os produtos!");
					// alert('Ocorreu um erro');
					console.log(response.return);
					// window.location.href = retorno+'&tela=atributos';
				}

				loadingHide();
			} catch(err) {
				alert('Ocorreu um erro');
				console.log(response);
				loadingHide();
			}
			loadingHide();
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

function add_produto(id, nome){

	nome = nome.replace("⁹", "'");

	loadingShow();

	$("#check_produto"+id).attr('disabled','disabled');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/produtos_busca_valores.php',
		async: true,
		data: {"id": id},
		success: function(response) {

			try {
				if(response.return){

					var valor = '';

					if(response.dado.valor_promocional != '0.00'){
						valor = response.dado.valor_promocional;
					}else{
						valor = response.dado.valor;
					}

					valor = parseFloat(valor);

					var html = '';
					html    += '<tr id="produto'+id+'">';
					html    += '<td>'+id+'</td>';
					html    += '<td>'+nome;
					html    += '<input type="hidden" name="produtos[]" value="'+id+'">';
					html    += '</td>';
					html    += '<td><a href="javascript:void(0);" class="text-yellow link_status" onclick="produto_excluir('+id+');"><i class="fa fa-times"></i> excluir</a></td>';
					html    += '</tr>';

					$("#produtos_table tbody").append(html);

					$("#produtos_pedido").show();

				}else{
					$("#mensagem_produto").addClass("alert-warning").show();
					$("#mensagem_produto p.dado_msg").append("Ocorreu um erro ao adcionar o produto!");
					// alert('Ocorreu um erro');
					console.log(response.return);
					// window.location.href = retorno+'&tela=atributos';
				}

				loadingHide();
			} catch(err) {
				alert('Ocorreu um erro');
				console.log(response);
				loadingHide();
			}
			loadingHide();
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

function produto_excluir(id){
	
	loadingShow();

	$("#check_produto"+id).removeAttr('disabled');
	$("#check_produto"+id).prop('checked',false);

	$("#produto"+id).remove();

	loadingHide();
}

function produto_excluir_edita(id_produto, id_categoria){
	
	loadingShow();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: base_url + '/content/class/categoria_deleta_produto.php',
		async: true,
		data: {"id_produto": id_produto, "id_categoria": id_categoria},
		success: function(response) {

			try {
				if(response.return){

					$("#produto"+id_produto).remove();

				}else{
					$("#mensagem_produto").addClass("alert-warning").show();
					$("#mensagem_produto p.dado_msg").append("Ocorreu um erro ao excluir o produto!");
					// alert('Ocorreu um erro');
					console.log(response.return);
					// window.location.href = retorno+'&tela=atributos';
				}

				loadingHide();
			} catch(err) {
				alert('Ocorreu um erro');
				console.log(response);
				loadingHide();
			}
			loadingHide();
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