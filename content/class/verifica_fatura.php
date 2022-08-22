<?php
require_once("../../config/start.php");
require_once("../../config/notificacoes.php");

$sqli = $bd->conexao();

$query = "SELECT * FROM setup_loja";

$data_criacao = $sqli->query($query);

$loja = $data_criacao->fetch_assoc();

if($loja['status_loja'] == 3){ // status 3 = período de testes

	$data = $loja["data_criacao"];

	$date = new DateTime($data); //dia da contratação

	$today = new DateTime(date('Y-m-d')); //dia atual

	$diferenca = $today->diff($date); //dia atual - dia da contratação

	if($diferenca->days == 15){

		notificar_cliente($loja['email_pagamento']);

	}
	else if($diferenca->days == 20){

		gerar_primeira_fatura();
		notificar_fatura($loja['email_pagamento']); //notifica sobre a fatura gerada

	}
	else if($diferenca->days >= 25){

		if($loja['status_pagamento'] == 1){

			bloqueia_loja($loja['loja_cnpj']);
			notificar_bloqueio($loja['email_pagamento']);

		}

	}

} 

else {

	$data = $loja["data_vencimento"];

	$date = new DateTime($data);

	$today = new DateTime(date('Y-m-d'));

	if( ($date->format('d') - 5) == $today->format('d')){ //se o dia de vencimento -5 dias, for igual ao dia de hoje, gera fatura. 

		gerar_fatura($loja['loja_cnpj']);
		notificar_fatura($loja['email_pagamento']); //notifica sobre a fatura gerada
	}
	else if($date->format('d') == $today->format('d')){ //se o dia de vencimento, for igual ao dia de hoje

		if($loja['status_pagamento'] == 1){ //se o pagamento estiver pendente

			notificar_fatura($loja['email_pagamento']); //notifica novamente sobre a fatura gerada
		}
	}

	else if(($date->format('d') + 5) == $today->format('d')){ //se o dia de vencimento + 5 dias, for igual ao dia de hoje

		if($loja['status_pagamento'] == 1){ //se o pagamento estiver pendente

			bloqueia_loja($loja['loja_cnpj']);
			notificar_bloqueio($loja['email_pagamento']);
		}
	}
}