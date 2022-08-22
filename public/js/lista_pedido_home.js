$(document).ready(function () {

	setInterval(function () {

		$.ajax({
			type: 'GET',
			dataType: 'json',
			url: base_url+'/content/class/pedidos_lista.php',
			async: true,
			success: function(response) {
				try {

					if(response.return){

						var id          = new Array();
						var verificador = 0;
						var html        = "";

						$.each(response.dados, function(valor, key){

							// console.log(key['valor']);
							// console.log(moeda(key['valor']));

							$( ".lista_pedido tbody tr td.id" ).each(function (index, value) {

									
									if($(this).attr('attr-id') != key['id'] ){
										// console.log('diferente');
										verificador = 0;
									}else{
										verificador = 1;
										// console.log('igual');
										return false;
									}

							});

							if (verificador == 0){

								html +='<tr id="dado_lista'+key['id']+'">';
								
								html +='<td class="id" attr-id="'+key['id']+'">'+key['id']+'</td>';
								html +='<td>'+data(key['data'])+'</td>';
								
								html +='<td>';
								html +='<a href="'+base_url+'/pedidos_visualiza/'+key['id']+'">'+key['nome_cliente']+' <small class="label label-success pedido_novo"><i class="fa fa-exclamation-triangle"></i> novo</small></a>';

								if(key['observacoes_entrega'] != ''){
									html += '<p class="help-block">';
									html += '<small>Obs.: '+key['observacoes_entrega']+'</small>';
									html += '</p>';
								}
								html +='</td>';

								html +='<td>'+key['telefone_cliente']+'</td>';
								html +='<td>R$ '+moeda(key['valor'])+'</td>';
								html +='<td>';
								
								if(key['tipo_pagamento'] == 7){
									html +='Dinheiro';
								}else if(key['tipo_pagamento'] == 6){
									html +='Cartão';
								}
										
								html +='</td>';
								html +='<td class="label_status">';
											
								if(key['status_pedido'] == 1){
                                    html +='<small class="label label-default">Pedido Realizado</small>';
                                }else if(key['status_pedido'] == 2){
                                    html +='<small class="label label-info">Pedido Impresso</small>';
                                }else if(key['status_pedido'] == 3){
                                    html +='<small class="label label-primary">Saiu para Entrega</small>';
                                }else if(key['status_pedido'] == 4){
                                    html +='<small class="label label-success">Pedido Entregue</small>';
                                }else if(key['status_pedido'] == 5){
                                    html +='<small class="label label-danger">Cancelado</small>';
                                }else if(key['status_pedido'] == 6){
                                    html +='<small class="label label-primary">Aguardando Pagamento</small>';
                                }else if(key['status_pedido'] == 7){
                                    html +='<small class="label label-success">Pagamento Confirmado</small>';
                                }else if(key['status_pedido'] == 8){
                                    html +='<small class="label label-danger">Pagamento Recusado</small>';
                                }else if(key['status_pedido'] == 9){
                                    html +='<small class="label label-warning">Pagamento em Análise</small>';
                                }else if(key['status_pedido'] == 10){
                                    html +='<small class="label label-gray-light">Pedido em Preparação</small>';
                                }
											
								html +='<div class="btn-group">';
								html +='<button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height: 18.23px;"><i class="fa fa-caret-down"></i></button>';
								html +='<ul class="dropdown-menu">';
								
								if(key['status_pedido'] == 1){
									html +='<li class="status2">';
									html +='<a href="javascript:void(0)" onclick="altera_status('+key['id']+', 2,\''+key['nome_cliente']+'\',\''+key['email_cliente']+'\')">Pedido Impresso</a>';
									html +='</li>';
									html +='<li class="status3">';
									html +='<a href="javascript:void(0)" onclick="altera_status('+key['id']+', 3,\''+key['nome_cliente']+'\',\''+key['email_cliente']+'\')">Saiu para Entrega</a>';
									html +='</li>';
									html +='<li class="status4">';
									html +='<a href="javascript:void(0)" onclick="altera_status('+key['id']+', 4,\''+key['nome_cliente']+'\',\''+key['email_cliente']+'\')">Pedido Entregue</a>';
									html +='</li>';
								
								}else if(key['status_pedido'] == 2){
								
									html +='<li class="status3">';
									html +='<a href="javascript:void(0)" onclick="altera_status('+key['id']+', 3,\''+key['nome_cliente']+'\',\''+key['email_cliente']+'\')">Saiu para Entrega</a>';
									html +='</li>';
									html +='<li class="status4">';
									html +='<a href="javascript:void(0)" onclick="altera_status('+key['id']+', 4,\''+key['nome_cliente']+'\',\''+key['email_cliente']+'\')">Pedido Entregue</a>';
									html +='</li>';
													
								}else if(key['status_pedido'] == 3){
								
									html +='<li class="status4">';
									html +='<a href="javascript:void(0)" onclick="altera_status('+key['id']+', 4,\''+key['nome_cliente']+'\',\''+key['email_cliente']+'\')">Pedido Entregue</a>';
									html +='</li>';
													
								}else if(key['status_pedido'] == 5){
								
									html +='<li><span class="text-red">Cancelado</span></li>';
								
								}
								
								html +='</ul>';
								html +='</div>';
								html +='</td>';
								html +='<td>';
								html +='<div class="btn-group">';
								html +='<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Ações <i class="fa fa-caret-down"></i>';
								html +='</button>';
								html +='<ul class="dropdown-menu">';
							
								html +='<li><a href="'+base_url+'/pedidos_visualiza/'+key['id']+'"><i class="fa fa-pencil"></i> Visualiza</a></li>';

								html +='<li><a href="'+base_url+'/pedidos_imprime/'+key['id']+'" target="_blank" onclick="altera_status_imprime('+key['id']+', 2,\''+key['nome_cliente']+'\',\''+key['email_cliente']+'\')" ><i class="fa fa-print"></i> Imprimir</a></li>';

								if(key['status_pedido'] != 8){
									html +='<li class="cancela_pedido">';
									html +='<a href="javascript:void(0);" class="text-red" onclick="cancela_pedido(\'pedidos\','+key['id']+');"><i class="fa fa-times"></i> Cancelar</a>';
									html +='</li>';
								}
								html +='</ul>';
								html +='</div>';
								html +='</td>';
								html +='</tr>';
								
							}

						});

						$(".lista_pedido tbody").prepend(html);

					}else{
						console.log(response.dados);
					}
					
				} catch(err) {
					alert('Por favor, recarregue a página.');
					console.log(err);
				}
			},
			error:function(r){
				console.log(r.responseText);
				console.log(r);
				// alert("Ocorreu algum erro.");
			}
		});
	}, 10000);

});

function moeda(v) {
	v=v.replace(/\D/g,"");
	v=v.replace(/(\d{1})(\d{14})$/,"$1.$2");
	v=v.replace(/(\d{1})(\d{11})$/,"$1.$2");
	v=v.replace(/(\d{1})(\d{8})$/,"$1.$2");
	v=v.replace(/(\d{1})(\d{5})$/,"$1.$2");
	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2");
	return v;
}

function data(v) {

    var data = new Date(v);
		dia  = data.getDate().toString().padStart(2, '0');
		mes  = (data.getMonth()+1).toString().padStart(2, '0');
		ano  = data.getFullYear();
		hora = data.getHours();
		min  = data.getMinutes();
		sec  = data.getSeconds().toString().padStart(2, '0');

	return dia+"/"+mes+"/"+ano+" "+hora+":"+min+":"+sec;
}