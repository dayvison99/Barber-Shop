<?php

class MontaEmail{

	public function recupera_senha($dados=array()){

		$sqli  = new mysqli(HOST_SERVER, USER_SERVER, PASS_SERVER, DB_SERVER);
		
		$query ="SELECT logo FROM design WHERE id = 1";
		$design = $sqli->query($query);
		$design = $design->fetch_array();

		if(!empty($design['logo'])){
			$logo  = PL_PATH_IMAGES_UPLOAD.'design/'.$design['logo'];
		}else{
			$logo = PL_PATH_ADMIN . '/public/img/no_image.jpg';
		}

		$query ="SELECT nome FROM setup WHERE id = 1";
		$setup = $sqli->query($query);
		$setup = $setup->fetch_array();

		$html = '';

		/***
		 * Header
		***/
		$html .= '<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%" class="box-msg" style="font-family: \'Source Sans Pro\',\'Helvetica Neue\',Helvetica,Arial,sans-serif;">';
		$html .= '<tr>';
		$html .= '<td align="center">';
		$html .= '<table cellspacing="0" cellpadding="0" border="0" width="650">';
		$html .= '<tr>';
		$html .= '<td valign="top" class="topo" style="text-align: center">';
		$html .= '<a href="'.PL_PATH_ADMIN.'">';
		$html .= '<img src="'.$logo.'" alt="'.$setup['nome'].'" class="logo-top" height="70" />';
		$html .= '</a>';
		$html .= '</td>';
		$html .= '</tr>';

		/***
		 * Body
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';

		$html .= '<h1 style="color: #353535; text-align: justify; font-size: 25px;">Olá, '.$dados["nome"].'!</h1>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Estamos te enviando um link para que você possa alterar sua senha!';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Para alterar sua senha do Projeto Loja, <a href="'.$dados["link"].'" target="_blank" style="color: #353535">clique aqui</a> ou cole o seguinte link no seu navegador:';
		$html .= '<br />';
		$html .= $dados["link"];
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Se não foi você a realizar essa solicitação? Ignore este email ou entre em contato com nosso suporte <a href="'.PL_PATH_ADMIN.'/atendimento" target="_blank" style="color: #353535">clicando aqui</a>.';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Esse link é válido por 24 horas a partir da solicitação de troca.';
		$html .= '</p>';

		$html .= '<br />';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Faça seu login clicando <a href="'.PL_PATH_ADMIN.'" style="color: #353535" >aqui</a>, para mais informaçoes.';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Sempre que existir alguma dúvida, estamos sempre disponíveis!';
		$html .= '</p>';

		$html .= '</td>';
		$html .= '</tr>';

		/***
		 * Footer
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Att, ' .$setup['nome'];
		$html .= '</p>';
		$html .= '<img src="'.$logo.'" alt="'.$setup['nome'].'" class="logo-footer" height="30"/>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';

		return $html;
	}

	public function statusPedido($dados=array()){

		$sqli  = new mysqli(HOST_SERVER, USER_SERVER, PASS_SERVER, DB_SERVER);
		
		$query ="SELECT logo FROM design WHERE id = 1";
		$design = $sqli->query($query);
		$design = $design->fetch_array();

		if(!empty($design['logo'])){
			$logo  = PL_PATH_IMAGES_UPLOAD.'design/'.$design['logo'];
		}else{
			$logo = PL_PATH_ADMIN . '/public/img/no_image.jpg';
		}

		$query ="SELECT nome FROM setup WHERE id = 1";
		$setup = $sqli->query($query);
		$setup = $setup->fetch_array();

		$html = '';

		/***
		 * Header
		***/
		$html .= '<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%" class="box-msg" style="font-family: \'Source Sans Pro\',\'Helvetica Neue\',Helvetica,Arial,sans-serif;">';
		$html .= '<tr>';
		$html .= '<td align="center">';
		$html .= '<table cellspacing="0" cellpadding="0" border="0" width="650">';
		$html .= '<tr>';
		$html .= '<td valign="top" class="topo" style="text-align: center">';
		$html .= '<a href="'.PL_BASE.'">';
		$html .= '<img src="'.$logo.'" alt="'.$setup["nome"].'" class="logo-top" height="70" />';
		$html .= '</a>';
		$html .= '</td>';
		$html .= '</tr>';

		/***
		 * Body
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';

		$html .= '<h1 style="color: #353535; text-align: justify; font-size: 25px;">Olá, '.$dados["nome"].'!</h1>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Estamos entrando em contato para lhe informar sobre o status do seu pedido';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Atualmente ele está: <strong>' . $dados["statusPedido"] .'</strong>';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= $dados["mensagem"];
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Faça seu login clicando <a href="'.PL_BASE.'/login" style="color: #353535" >aqui</a>, para mais informaçoes.';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Sempre que existir alguma dúvida, estamos sempre disponíveis!';
		$html .= '</p>';

		$html .= '</td>';
		$html .= '</tr>';

		/***
		 * Footer
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Obrigado pela parceria e confiança.';
		$html .= '</p>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Att, '.$setup["nome"];
		$html .= '</p>';
		$html .= '<img src="'.$logo.'" alt="'.$setup["nome"].'" class="logo-footer" height="30"/>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';

		return $html;
	}

	public function fatura_atualizada($statusFatura)
	{
		$sqli  = new mysqli(HOST_SERVER, USER_SERVER, PASS_SERVER, DB_SERVER);
		$query = "SELECT * FROM design";
		$result = $sqli->query($query);

		$query_c = "SELECT * FROM setup";
		$result_c = $sqli->query($query_c);

		$design = $result->fetch_array();
		$configuracoes = $result_c->fetch_array();

		$html = '';

		/***
		 * Header
		***/
		$html .= '<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%" class="box-msg" style="font-family: \'Source Sans Pro\',\'Helvetica Neue\',Helvetica,Arial,sans-serif;">';
		$html .= '<tr>';
		$html .= '<td align="center">';
		$html .= '<table cellspacing="0" cellpadding="0" border="0" width="650">';
		$html .= '<tr>';
		$html .= '<td valign="top" class="topo" style="text-align: center">';
		$html .= '<a href="'.PL_PATH_ADMIN.'">';
		$html .= '<img src="'.PL_PATH_ADMIN.'/public/img/logo.png" alt="Projeto Loja" class="logo-top" height="70" />';
		$html .= '</a>';
		$html .= '</td>';
		$html .= '</tr>';

		/***
		 * Body
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';

		$html .= '<h1 style="color: #353535; text-align: justify; font-size: 25px;">Olá!</h1>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Estamos entrando em contato para lhe informar que sua fatura teve seu status alterado.';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'O status de sua fatura foi alterado para:'.$statusFatura.'.';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Entre em contato conosco sempre que existir alguma dúvida, estamos sempre disponíveis!';
		$html .= '</p>';

		$html .= '</td>';
		$html .= '</tr>';


		/***
		 * Footer
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Obrigado pela parceria e confiança.';
		$html .= '</p>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Att, Projeto Loja';
		$html .= '</p>';
		$html .= '<img src="'.PL_PATH_ADMIN.'/public/img/logo.png" alt="Projeto Loja" class="logo-footer" height="30"/>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';

		return $html;
	}

	public function pagamento_cartao()
	{

		$sqli  = new mysqli(HOST_SERVER, USER_SERVER, PASS_SERVER, DB_SERVER);
		$query = "SELECT * FROM design";
		$result = $sqli->query($query);

		$query_c = "SELECT * FROM setup";
		$result_c = $sqli->query($query_c);

		$design = $result->fetch_array();
		$configuracoes = $result_c->fetch_array();

		$html = '';

		/***
		 * Header
		***/
		$html .= '<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%" class="box-msg" style="font-family: \'Source Sans Pro\',\'Helvetica Neue\',Helvetica,Arial,sans-serif;">';
		$html .= '<tr>';
		$html .= '<td align="center">';
		$html .= '<table cellspacing="0" cellpadding="0" border="0" width="650">';
		$html .= '<tr>';
		$html .= '<td valign="top" class="topo" style="text-align: center">';
		$html .= '<a href="'.PL_PATH_ADMIN.'">';
		$html .= '<img src="'.PL_PATH_IMG.'design/'.$design['logo'].'" alt="'.$configuracoes['nome'].'" class="logo-top" height="70" />';
		$html .= '</a>';
		$html .= '</td>';
		$html .= '</tr>';


		/***
		 * Body
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';

		$html .= '<h1 style="color: #353535; text-align: justify; font-size: 25px;">Olá!</h1>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Estamos entrando em contato para lhe informar que o pagamento de sua fatura está em análise.';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Entre em contato conosco sempre que existir alguma dúvida, estamos sempre disponíveis!';
		$html .= '</p>';

		$html .= '</td>';
		$html .= '</tr>';
		

		/***
		 * Footer
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Obrigado pela parceria e confiança.';
		$html .= '</p>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Att, Projeto Loja';
		$html .= '</p>';
		$html .= '<img src="'.PL_PATH_ADMIN.'/public/img/logo.png" alt="Projeto Loja" class="logo-footer" height="30"/>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';

		return $html;
	}

	public function pagamento_boleto($boleto)
	{

		$sqli  = new mysqli(HOST_SERVER, USER_SERVER, PASS_SERVER, DB_SERVER);
		$query = "SELECT * FROM design";
		$result = $sqli->query($query);

		$query_c = "SELECT * FROM setup";
		$result_c = $sqli->query($query_c);

		$design = $result->fetch_array();
		$configuracoes = $result_c->fetch_array();

		$html = '';

		/***
		 * Header
		***/
		$html .= '<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%" class="box-msg" style="font-family: \'Source Sans Pro\',\'Helvetica Neue\',Helvetica,Arial,sans-serif;">';
		$html .= '<tr>';
		$html .= '<td align="center">';
		$html .= '<table cellspacing="0" cellpadding="0" border="0" width="650">';
		$html .= '<tr>';
		$html .= '<td valign="top" class="topo" style="text-align: center">';
		$html .= '<a href="'.PL_PATH_ADMIN.'">';
		$html .= '<img src="'.PL_PATH_ADMIN.'/public/img/logo.png" alt="Projeto Loja" class="logo-top" height="70" />';
		$html .= '</a>';
		$html .= '</td>';
		$html .= '</tr>';


		/***
		 * Body
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';

		$html .= '<h1 style="color: #353535; text-align: justify; font-size: 25px;">Olá!</h1>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Estamos entrando em contato para lhe informar que uma nova fatura foi gerada.';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Você pode efetuar o pagamento do boleto clicando neste link: <a src="'.$boleto.'">Boleto</a>.';
		$html .= '</p>';

		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Entre em contato conosco sempre que existir alguma dúvida, estamos sempre disponíveis!';
		$html .= '</p>';

		$html .= '</td>';
		$html .= '</tr>';
		

		/***
		 * Footer
		***/
		$html .= '<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">';
		$html .= '<td>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Obrigado pela parceria e confiança.';
		$html .= '</p>';
		$html .= '<p style="color: #353535; text-align: justify;">';
		$html .= 'Att, Projeto Loja';
		$html .= '</p>';
		$html .= '<div style=""><img src="'.PL_PATH_ADMIN.'/public/img/logo.png" alt="Projeto Loja" class="logo-footer" height="30"/></div>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';

		return $html;
	}
}