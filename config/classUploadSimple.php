<?php 
class Upload{

	public function uploadImage($nome_imagem = '', $thumb=true, $pasta = '', $tabela = '', $largura=1500, $altura=1500, $tamanho=1000000, $foto = null){

		$error = array();

		if(empty($foto))
			$foto = $_FILES["imagem"];

		// Se a foto estiver sido selecionada
		if (!empty($foto["name"])) {
	 
	    	// Verifica se o arquivo é uma imagem
	    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp|vnd.microsoft.icon)$/", $foto["type"])){
	     	   $error[] = "Isso não é uma imagem.";
	   	 	} 
		
			// Pega as dimensões da imagem
			$dimensoes = getimagesize($foto["tmp_name"]);
		
			// Verifica se a largura da imagem é maior que a largura permitida
			if($dimensoes[0] > $largura) {
				$error[] = " Largura maior que:<strong> ".$largura." pixels</strong>";
			}
	 
			// Verifica se a altura da imagem é maior que a altura permitida
			if($dimensoes[1] > $altura) {
				$error[] = " Altura maior que:<strong> ".$altura." pixels</strong>";
			}
			
			// Verifica se o tamanho da imagem é maior que o tamanho permitido
			if($foto["size"] > $tamanho) {
	   		 	$error[] = " Tamanho da imagamem maior que: <strong> 1 Mega</strong>";
			}

			// pre($foto);
			// pre($error);
			// exit();
	 
			// Se não houver nenhum erro
			if (count($error) == 0) {
			
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg|ico){1}$/i", $foto["name"], $ext);
	 
	        	// Gera um nome único para a imagem
	        	if($nome_imagem == ''){
	        		$nome_imagem =  md5(uniqid(time()));
	        	}
	 
	        	// Caminho de onde ficará a imagem
				$caminho_imagem = PL_PATH."/uploads/".PASTA_UPLOAD.'/'.$pasta.'/'.$nome_imagem.".".$ext[1];
	 
				// Faz o upload da imagem para seu respectivo caminho
				if(!move_uploaded_file($foto["tmp_name"], $caminho_imagem)){
					$error[] = " Não foi possível salvar a imagem no caminhos especificado!";
					return $error;
					exit();
				}

				return '';
				exit();
			
			}else{
				return $error;
				exit();
			}
		}
	}
}