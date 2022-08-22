function select_tipo_frete(id){

	if(id == 1){
		         
		$('#tipo_1').show();
		$('#tipo_2').hide();
		$('#tipo_3').hide();
		$('#tipo_4').hide();
		
	}else if(id == 2){

		$('#tipo_1').hide();
		$('#tipo_2').show();
		$('#tipo_3').hide();
		$('#tipo_4').hide();

	}else if(id == 3){

		$('#tipo_1').hide();
		$('#tipo_2').hide();
		$('#tipo_3').show();
		$('#tipo_4').hide();

	}else if(id == 4){

		$('#tipo_1').hide();
		$('#tipo_2').hide();
		$('#tipo_3').hide();
		$('#tipo_4').show();
	}

}

function addFretes(){
	var valor   = $("#valor").val(),
	    bairros = $("#bairros").val(),
	    ceps    = $("#ceps").val(),
		qtDiv   = $("#lista_bairros tbody tr").length + 1,
		html    = '';
    if(ceps != ''){
        html += '<tr id="linha_frete'+qtDiv+'">';
	
    	html += '<td>'+qtDiv+'</td>';
    
    	html += '<td><input type="text" class="form-control money" onkeypress="mascara(this,money)" value="'+valor+'" name="valor_frete[]"></td>';
    	html += '<td><input type="text" class="form-control money" value="'+bairros+'" name="bairros_frete[]"></td>';
    	html += '<td><input type="text" class="form-control money" value="'+ceps+'" name="ceps_frete[]"></td>';
    
    	html += '<td><a href="javascript:void(0);" class="text-red" onclick="removeFrete('+qtDiv+');"><i class="fa fa-times"></i> Excluir</a></td>';
    
    	html += '</tr>';
    
    	$("#lista_bairros tbody").append(html);
    	$("#lista_bairros").show();
    	$("#valor").val('');
    	$("#bairros").val('');
    	$("#ceps").val('');
    }else{
        document.getElementById("alert-error").innerHTML = "O campo CEP's deve ser preenchido!";
    }
}

function removeFrete(id){
	$("#linha_frete"+id).remove();
}

function addFretesAgendado(){
	var valor   = $("#valor_agendado").val(),
	    bairros = $("#bairros_agendado").val(),
	    ceps    = $("#ceps_agendado").val(),
		qtDiv   = $("#lista_bairros_agendado tbody tr").length + 1,
		html    = '';

	$('.erro_frete').empty();
	$('.erro_frete').hide();

	if (valor == ''){
		$("#valor_agendado").focus();
		$('.erro_frete').append('selecione um valor');
		$('.erro_frete').show();
	}else{

		html += '<tr id="linha_frete'+qtDiv+'">';
		
		html += '<td>'+qtDiv+'</td>';

		html += '<td><input type="text" class="form-control money" onkeypress="mascara(this,money)" value="'+valor+'" name="valor_frete_agendado[]" readonly></td>';
		html += '<td><input type="text" class="form-control money" value="'+bairros+'" name="bairros_frete_agendado[]" readonly></td>';
		html += '<td><input type="text" class="form-control money" value="'+ceps+'" name="ceps_frete_agendado[]" readonly></td>';

		html += '<td><a href="javascript:void(0);" class="text-red" onclick="removeFreteAgendado('+qtDiv+');"><i class="fa fa-times"></i> Excluir</a></td>';

		html += '</tr>';

		$("#lista_bairros_agendado tbody").append(html);
		$("#lista_bairros_agendado").show();
		$("#valor_agendado").val('');
		$("#bairros_agendado").val('');
		$("#ceps_agendado").val('');
	}
}

function removeFreteAgendado(id){
	$("#linha_frete_agendado"+id).remove();
}

function addHorariosAgendado(){
	var dia = $("#dia_agendado").val(),
		inicio = $("#horario_inicio_agendado").val(),
	    final = $("#horario_final_agendado").val(),
	    antecedencia = $("#tempo_antecedencia_agendado").val(),
	    tolerancia = $("#prazo_tolerancia_agendado").val(),
		qtDiv = $("#lista_horarios_agendado tbody tr").length + 1,
		html = '';

	$('.erro_horarios').empty();
	$('.erro_horarios').hide();

	if(dia == null){
		$("#dia_agendado").focus();
		$('.erro_horarios').append('selecione um dia');
		$('.erro_horarios').show();
	}else if(inicio == ''){
		$("#horario_inicio_agendado").focus();
		$('.erro_horarios').append('selecione o horario de início');
		$('.erro_horarios').show();
	}else if(final == ''){
		$("#horario_final_agendado").focus();
		$('.erro_horarios').append('selecione o horario de encerramento');
		$('.erro_horarios').show();
	}else if(antecedencia == ''){
		$("#tempo_antecedencia_agendado").focus();
		$('.erro_horarios').append('selecione o tempo de antecedencia');
		$('.erro_horarios').show();
	}else if(tolerancia == ''){
		$("#prazo_tolerancia_agendado").focus();
		$('.erro_horarios').append('selecione o tempo de tolerância');
		$('.erro_horarios').show();
	}else{

		if(dia == 1) {
			dia = 'Domingo';
			// $('#dia_agendado option:eq(1)').attr('disabled', 'disabled');
		} else if(dia == 2) {
			dia = 'Segunda';
			// $('#dia_agendado option:eq(2)').attr('disabled', 'disabled');
		} else if(dia == 3) {
			dia = 'Terça';
			// $('#dia_agendado option:eq(3)').attr('disabled', 'disabled');
		} else if(dia == 4) {
			dia = 'Quarta';
			// $('#dia_agendado option:eq(4)').attr('disabled', 'disabled');
		} else if(dia == 5) {
			dia = 'Quinta';
			// $('#dia_agendado option:eq(5)').attr('disabled', 'disabled');
		} else if(dia == 6) {
			dia = 'Sexta';
			// $('#dia_agendado option:eq(6)').attr('disabled', 'disabled');
		} else if(dia == 7) {
			dia = 'Sabado';
			// $('#dia_agendado option:eq(7)').attr('disabled', 'disabled');
		}

		html += '<tr id="linha_frete_agendado'+qtDiv+'">';
		
		html += '<td>'+qtDiv+'</td>';

		html += '<td><input type="text" class="form-control" value="'+dia+'" name="dia_agendado[]" readonly></td>';
		html += '<td><input type="text" class="form-control" value="'+inicio+'" name="horario_inicio_agendado[]" readonly></td>';
		html += '<td><input type="text" class="form-control money" value="'+final+'" name="horario_final_agendado[]" readonly></td>';
		html += '<td><input type="text" class="form-control money" value="'+antecedencia+'" name="tempo_antecedencia_agendado[]" readonly></td>';
		html += '<td><input type="text" class="form-control money" value="'+tolerancia+'" name="prazo_tolerancia_agendado[]" readonly></td>';

		html += '<td><a href="javascript:void(0);" class="text-red" onclick="removeHorarioAgendado('+qtDiv+');"><i class="fa fa-times"></i> Excluir</a></td>';

		html += '</tr>';

		$("#lista_horarios_agendado tbody").append(html);
		$("#lista_horarios_agendado").show();
		$("#dia_agendado").val('');
		$("#horario_inicio_agendado").val('');
		$("#horario_final_agendado").val('');
		$("#tempo_antecedencia_agendado").val('');
		$("#prazo_tolerancia_agendado").val('');
	}
}

function removeHorarioAgendado(id){
	$("#linha_frete_agendado"+id).remove();
}