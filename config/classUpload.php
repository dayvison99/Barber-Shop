<?php 
class Upload{

	public function uploadImage($key=0, $nome_imagem = '', $thumb=true, $pasta = '', $tabela = '',$largura=1500, $altura=1500, $tamanho=1000000){

		//Largura maxima em pixels
		$largura = 1500;
		// Altura maxima em pixels
		$altura = 1500;
		// Tamanho maximo do arquivo em bytes
		$tamanho = 1000000;

		$error = array();

		$foto = $_FILES["imagem"];
	
		// Se a foto estiver sido selecionada
		if (!empty($foto["name"])) {
	 
	    	// Verifica se o arquivo é uma imagem
	    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp|vnd.microsoft.icon)$/", $foto["type"][$key])){
	     	   $error[1] = "Isso não é uma imagem.";
	   	 	} 
		
			// Pega as dimensões da imagem
			$dimensoes = getimagesize($foto["tmp_name"][$key]);
		
			// Verifica se a largura da imagem é maior que a largura permitida
			if($dimensoes[0] > $largura) {
				$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
			}
	 
			// Verifica se a altura da imagem é maior que a altura permitida
			if($dimensoes[1] > $altura) {
				$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
			}
			
			// Verifica se o tamanho da imagem é maior que o tamanho permitido
			if($foto["size"][$key] > $tamanho) {
	   		 	$error[4] = "A imagem deve ter no máximo 1 Mega";
			}

			// pre($foto);
			// pre($error);
			// exit();
	 
			// Se não houver nenhum erro
			if (count($error) == 0) {
			
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg|ico){1}$/i", $foto["name"][$key], $ext);
	 
	        	// Gera um nome único para a imagem
	        	if($nome_imagem == ''){
	        		$nome_imagem =  md5(uniqid(time()));
	        	}
	 
	        	// Caminho de onde ficará a imagem
	        	$caminho_imagem = PL_PATH."/uploads/".PASTA_UPLOAD.'/'.$pasta.'/'.$nome_imagem.".".$ext[1];
	 
				// Faz o upload da imagem para seu respectivo caminho
				if(!move_uploaded_file($foto["tmp_name"][$key], $caminho_imagem)){
					$erro[5] = "Não foi possível salvar a imagem no caminhos especificado!";
				}				
		
				// Se houver mensagens de erro, exibe-as
				if (count($error) != 0) {
					foreach ($error as $erro) {
						echo $erro . "<br />";
						exit();
					}
				}
			
			}
		
			// Se houver mensagens de erro, exibe-as
			if (count($error) != 0) {
				foreach ($error as $erro) {
					echo $erro . "<br />";
					exit();
				}
			}
		}
	}
}