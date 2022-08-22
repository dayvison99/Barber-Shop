$(document).ready(function($) {

	$('#form_cliente').validate({
		rules: {
			nome: {
				required: true
			},
			email: {
				required: true
			}
		}
	});

});

function submit_form(type_buton) {

	var form = $("#form_cliente");
	
	form.append('<input type="hidden" name="salvar" value="'+type_buton+'">');

	loadingShow();

	form.submit();

}