<?php

class Pagination{

	function createLinks($dados=array(), $tabela='' ,$where='', $order_by=array(), $type_order_by='ASC', $limit = 25, $offset = 0, $page = 1, $return_page = '',$link='', $join_tabela=array(), $join_where=array(), $page_return=''){

		if($page == ""){
			$page = 0;
		}

		if(!empty($dados)){

			$campos = '';
			if(!empty($dados)){
				foreach ($dados as $value) {
					$campos .= $value.',';
				}
				$campos = substr($campos, 0, -1);
			}else{
				$campos = 'id';
			}

			$dados_where = '';
			if(!empty($where)){
				foreach ($where as $key => $value) {
					if($key == 0){
						$dados_where .= 'WHERE ' . $value;
					}else{
						$dados_where .= ' AND ' . $value;
					}
				}
			}

			$dados_join = '';
			if((!empty($join_tabela)) && (!empty($join_where))){

				foreach ($join_where as $key => $value) {
					
					$dados_join .= "LEFT JOIN ". $join_tabela[$key]." ON ".$value;
					
				}

				$dados_join .="LEFT JOIN ". $join_tabela." ON ".$join_where;
			}

			$dados_order_by = '';
			$type_order = array();
			if(!empty($order_by)){

				foreach ($order_by as $key => $value) {

					if(is_array($type_order_by)){
						$type_order[$key] = $type_order_by[$key];
					}else{
						$type_order[$key] = $type_order_by;
					}

					if($key == 0){
						$dados_order_by .= "ORDER BY " . $value . " ". $type_order[$key];
					}else{
						$dados_order_by .= ", " . $value . " ". $type_order[$key];
					}
					// $dados_order_by .= " " . $type_order_by;
				}
			}

			$sqli  = new mysqli(HOST_SERVER, USER_SERVER, PASS_SERVER, DB_SERVER);

			$query = "SELECT $campos FROM $tabela $dados_join $dados_where";

			// pre($query);
			// pre($sqli->query($query));
			// exit();

			$total_rows = $sqli->query($query);

			// pre($total_rows);

			if(!empty($total_rows) && ($total_rows->num_rows > $limit)){

				$config_page = "";
				
				$num_pages = (int) ceil($total_rows->num_rows / $limit);

				//Volta uma Página / Primeira Página
				if($page == 0){
					$config_page .= '<li><a href="javascript:void(0);">« «</a></li>';
					$config_page .= '<li><a href="javascript:void(0);">«</a></li>';
				}else{

					if(!empty($page_return)){
						$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.$return_page.'">1...</a></li>';
						if( (($page-1) == 0) OR (($page-1) == 1) ){
							$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.$return_page.'">«</a></li>';
						}else{
							$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.($page-1).$return_page.'">«</a></li>';
						}
					}else{

						$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.$return_page.'">1...</a></li>';
						if( (($page-1) == 0) OR (($page-1) == 1) ){
							$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.$return_page.'">«</a></li>';
						}else{
							$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.($page-1).$return_page.'">«</a></li>';
						}
					}
				}

				//Paginas Numeradas

				if($num_pages >= 7){

					if($page <= 4){

						for ($i = 1; $i <= 7; $i++) {

							if($i == $page){

								$config_page .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';

							}else{

								if($i == 1){
									if($page == 0){
										$config_page .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
									}else{
										if(!empty($page_return)){
											$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.$return_page.'">'.$i.'</a></li>';
										}else{
											$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.$return_page.'">'.$i.'</a></li>';
										}
									}
								}else{
									if(!empty($page_return)){
										$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
									}else{
										$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
									}
								}
							}
						}

					}elseif( ($num_pages - $page) <= 3){

						for ($i = ($num_pages-6); $i <= $num_pages; $i++) {

							if($i == $page){

								$config_page .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';

							}else{

								if($i == 1){
									if($page == 0){
										$config_page .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
									}else{
										if(!empty($page_return)){
											$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.$return_page.'">'.$i.'</a></li>';
										}else{
											$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.$return_page.'">'.$i.'</a></li>';
										}
									}
								}else{
									if(!empty($page_return)){
										$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
									}else{
										$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
									}
								}
							}
						}

					}else{

						for ($i = ($page - 3); $i < $page ; $i++) {

							if(!empty($page_return)){
								$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
							}else{
								$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
							}
						}

						$config_page .= '<li class="active"><a href="javascript:void(0);">'.$page.'</a></li>';

						for ($i = ($page+1); $i < ($page + 4) ; $i++) {
							if(!empty($page_return)){
								$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
							}else{
								$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
							}
						}

					}
				}else{
					for ($i = 1; $i <= $num_pages; $i++) {

						if($i == $page){

							$config_page .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';

						}else{

							if($i == 1){
								if($page == 0){
									$config_page .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
								}else{
									if(!empty($page_return)){
										$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.$return_page.'">'.$i.'</a></li>';
									}else{
										$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.$return_page.'">'.$i.'</a></li>';
									}
								}
							}else{
								if(!empty($page_return)){
									$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
								}else{
									$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.$i.$return_page.'">'.$i.'</a></li>';
								}
							}
						}
					}
				}


				//Avança uma pagina
				if($page == $num_pages){
					$config_page .= '<li><a href="javascript:void(0);">»</a></li>';
					$config_page .= '<li><a href="javascript:void(0);">» »</a></li>';
				}else{
					if(!empty($page_return)){
						if($page == 0){
							$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.($page+2).$return_page.'">»</a></li>';
						}else{
							$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.($page+1).$return_page.'">»</a></li>';
						}
						$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$page_return.'&pag='.$num_pages.$return_page.'">...'.$num_pages.'</a></li>';
					}else{
						if($page == 0){
							$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.($page+2).$return_page.'">»</a></li>';
						}else{
							$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.($page+1).$return_page.'">»</a></li>';
						}
						$config_page .= '<li><a href="'.PL_PATH_ADMIN.'/'.$tabela.'&pag='.$num_pages.$return_page.'">...'.$num_pages.'</a></li>';						
					}
				}

				if($page == 0){
					$offset = 0;
				}else{
					$offset = $limit * ($page - 1);
				}

				$query = "SELECT $campos FROM $tabela $dados_join $dados_where $dados_order_by LIMIT $limit OFFSET $offset";

				// pre($query);

				$result = $sqli->query($query);

				$sqli->close();

				$dados = array(
								'paginas' => $config_page,
								'dados'   => $result
								);

				return $dados;

				// pre($offset);
				// pre($page);
				// pre($config_page);
				// // pre($total_rows->num_rows);
				// // pre($num_pages);
				// pre("busca ->");
				// foreach ($result as $key => $value) {
				// 	pre($value['id']);
				// }
				// exit;

			}else{
				$query = "SELECT $campos FROM $tabela $dados_join $dados_where $dados_order_by LIMIT $limit OFFSET $offset";

				$result = $sqli->query($query);

				$sqli->close();

				$dados = array(
								'paginas' => "",
								'dados'   => $result
								);

				return $dados;
			}

		}else{
			return false;
		}
	}
}