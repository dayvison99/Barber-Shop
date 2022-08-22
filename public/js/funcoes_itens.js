
$(".item_imagem").hide();

function adiciona_opcao() {

	loadingShow();

	if ($("#itens_opcoes table tbody tr:last-child").length == 0) {
		var qtDiv = 1;
	} else {
		var qtDiv = parseInt($("#itens_opcoes table tbody tr:last-child").attr('id').split("_")[1]) + 1
	}

	var nome = $("#opcao_item").val(),
		html = '';

	html += '<tr id="opcao_' + qtDiv + '">';
	html += '<td>' + qtDiv + '</td>';
	html += '<td id="lista_configuravel">';
	html += '<input type="text" name="item_nome[]" value="' + nome + '" style="width:100%;">';
	html += '</td>';
	html += '<td>';
	html += '<input type="file" name="item_imagem[]" style="width:100%; text-align:center">';
	html += '</td>';
	html += '<td>';
	html += '<input type="text" name="item_valor[]" value="0" style="width:100%; text-align:center" onkeyup="money(this);">';
	html += '</td>';
	html += '<td>';
	html += '<input type="number" name="item_ordem[]" value="0" style="width:100%; text-align:center">';
	html += '</td>';
	html += '<td>';
	html += '<label for="status">Status:</label>';
	html += '<select id="status" name="status[]">';
	html += '<option value="0" selected="">Desativo</option> <option value="1">Ativo</option>';
	html += '</select>';
	html += '</td>';
	html += '<td>';
	html += '<a href="javascript:void(0);" class="text-red" data-imagem="" id="deleta_opcao_' + qtDiv + '" onclick="deleta_opcao_novo(' + qtDiv + ');"><i class="fa fa-times"></i> Excluir</a>';
	html += '</td>';
	html += '</tr>';

	$("#itens_opcoes table tbody").append(html);

	$("#itens_opcoes").show();

	$("#opcao_item").val("");

	loadingHide();
}

function deleta_opcao(value, id_opcao) {
	var confirmacao = confirm("Deseja excluir a Opção " + value + "?");

	if (confirmacao) {
		loadingShow();
		var imagem = $("#deleta_opcao_" + value).attr("data-imagem");
		$.post("../class/itens_edita.php", { id_opcao: id_opcao, imagem: imagem }, function (data) {
			if (data == 1) {
				$("#opcao_" + value).remove();
				loadingHide();
			} else {
				alert("Algo deu errado!");
				loadingHide();
			}
		});
	}
}

function deleta_opcao_novo(value) {
	var confirmacao = confirm("Deseja excluir a Opção " + value + "?");

	if (confirmacao) {
		loadingShow();
		$("#opcao_" + value).remove();
		loadingHide();
	}
}

function deleta_imagem(id_imagem, imagem) {

	$.post("../class/itens_edita.php", { id_imagem: id_imagem, imagem: imagem }, function (data) {
		if (data == 1) {
			$("#preview_" + id_imagem).remove();
			$("#item_imagem_" + id_imagem).show();
			$("#remover").hide();
		} else {
			alert("Algo deu errado!");
		}
	});
}