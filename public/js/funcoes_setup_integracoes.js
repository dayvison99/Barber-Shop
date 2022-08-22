function select_integracao(id){

	loadingShow();

	$("#codigo_integracao h3 span").html("");

	if(id == 1){
		var html = "o Google Analytics";
	}else if(id == 2){
		var html = "o Jivochat";
	}

	$("#codigo_integracao h3 span").append(html);
	$("#codigo_integracao").show();

	loadingHide();
}