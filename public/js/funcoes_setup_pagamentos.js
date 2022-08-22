function select_tipo_pagamento(id){

	if(id == 3){
				 
		$('#tipo_3').show();
		$('#tipo_4').hide();
		$('#tipo_6').hide();
		$('#tipo_7').hide();
		$('#tipo_8').hide();
		
	}else if(id == 4){

		$('#tipo_3').hide();
		$('#tipo_4').show();
		$('#tipo_6').hide();
		$('#tipo_7').hide();
		$('#tipo_8').hide();

	}else if(id == 6){

		$('#tipo_3').hide();
		$('#tipo_4').hide();
		$('#tipo_6').show();
		$('#tipo_7').hide();
		$('#tipo_8').hide();

	}else if(id == 7){

		$('#tipo_3').hide();
		$('#tipo_4').hide();
		$('#tipo_6').hide();
		$('#tipo_7').show();
		$('#tipo_8').hide();

	}else if(id == 8){

		$('#tipo_3').hide();
		$('#tipo_4').hide();
		$('#tipo_6').hide();
		$('#tipo_7').hide();
		$('#tipo_8').show();
	}

}