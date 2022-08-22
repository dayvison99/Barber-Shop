function salvarHorario(){
	dias = [];
	horario_abertura = $('#horario_abertura').val();
	horario_fechamento = $('#horario_fechamento').val();
	qtDiv = $("#lista_horarios tbody tr").length + 1;


	$('.erro-horario').empty();
	$('.erro-horario').hide();

	if(horario_abertura == ''){
		$('.erro-horario').append('Informe um horário de abertura');
		$('.erro-horario').show();
		$('#horario_abertura').focus();
	}else if(horario_fechamento == ''){
		$('.erro-horario').append('Informe um horário de fechamento');
		$('.erro-horario').show();
		$('#horario_fechamento').focus();
	}else if ($("#dias_horarios input:checkbox:checked").length == 0){
		$('.erro-horario').append('Escolha pelo menos um dia');
		$('.erro-horario').show();
	}else{
		$("#dias_horarios input:checkbox:checked").each(function(){
			html = ''

			html += '<tr id="lista_horarios_linha'+qtDiv+'">';
				html += '<td>'+qtDiv+'</td>';
				html += '<td><input type="text" readonly name="dia[]" value="'+$(this).val()+'"></td>';
				html += '<td><input type="time" name="horario_abertura[]" value="'+horario_abertura+'"></td>';
				html += '<td><input type="time" name="horario_fechamento[]" value="'+horario_fechamento+'"></td>';
				html += '<td><a href="javascript:void(0);" class="text-red" onclick="removeHorario('+qtDiv+');"><i class="fa fa-times"></i> Excluir</a></td>';
			html += '</tr>';

			$("#lista_horarios tbody").append(html);

			$(this).prop('checked', false);
			$(this).attr('disabled', 'disabled');
			$('#horario_abertura').val('');
			$('#horario_fechamento').val('');
			qtDiv++
		});
		
	}
}

function removeHorario(id){
	dia = $("#lista_horarios_linha"+id+" input[name='dia[]']").val();
	$("#dias_horarios input:checkbox").each(function(){
		if($(this).val() == dia){
			$(this).removeAttr('disabled');
		}
	});
	$("#lista_horarios_linha"+id).remove();
}