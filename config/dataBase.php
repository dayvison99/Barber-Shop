<?php
class Banco
{
	private $status;
	private $HOST_SERVER;
	private $USER_SERVER;
	private $PASS_SERVER;
	private $DB_SERVER;

	public function __construct($constantes = [])
	{
		if (empty($constantes)) {
			$this->HOST_SERVER = HOST_SERVER;
			$this->USER_SERVER = USER_SERVER;
			$this->PASS_SERVER = PASS_SERVER;
			$this->DB_SERVER = DB_SERVER;
		} else {
			$this->HOST_SERVER = $constantes['HOST_SERVER'];
			$this->USER_SERVER = $constantes['USER_SERVER'];
			$this->PASS_SERVER = $constantes['PASS_SERVER'];
			$this->DB_SERVER = $constantes['DB_SERVER'];
		}
		$this->iniciar();
	}

	private function iniciar()
	{	
		$link = mysqli_connect($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);
		if($link)
		{
			$this->status = true;
		}
		else 
		{
			$this->status = false;
		}
	}
	 
	public function Link()
	{
		return mysqli_connect($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);
	}
	 
	public function StatusConecxao()
	{
		return $this->status;
	}

	public function conexao()
	{
		return new mysqli($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);
	}

	public function select($dados=array(), $tabela='' ,$where='', $order_by=array(), $type_order_by='ASC', $limit = '25', $offset = '0')
	{

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

			$sqli  = new mysqli($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);

			$query = "SELECT $campos FROM $tabela $dados_where $dados_order_by LIMIT $limit OFFSET $offset";

			// pre($query);

			$result = $sqli->query($query);

			$sqli->close();

			return $result;

		}else{
			return false;
		}
	}

	public function update_status($tabela='' ,$id='')
	{
		if(!empty($tabela)){

			$sqli  = new mysqli($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);

			$query = "UPDATE $tabela SET status = IF(status = 0, 1, 0) WHERE id = $id";

			$sqli->query($query);

			$sqli->close();

			if(!$sqli->connect_errno){
				return true;
				exit;
			}else{
				return($sqli->error_list);
				exit;
			}

		}else{
			return "Nenhum dado encontrado!";
		}
	}

	public function delete($tabela='' ,$id='')
	{
		if(!empty($tabela)){

			$sqli  = new mysqli($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);

			$query = "UPDATE $tabela SET excluido = IF(excluido = 0, 1, 0) WHERE id_tarefa = $id";

			$sqli->query($query);

			$sqli->close();

			if(!$sqli->connect_errno){
				return true;
				exit;
			}else{
				return($sqli->error_list);
				exit;
			}

		}else{
			return "Nenhum dado encontrado!";
		}
	}

	public function update_dado($tabela='', $dado=array() ,$id='')
	{
		if(!empty($tabela)){

			$dados_set = '';
			if(!empty($dado)){
				foreach ($dado as $key => $value) {
					$dados_set .= key($dado)."='".$value."',";
				}

				$dados_set = substr($dados_set, 0, -1);
			}

			$sqli  = new mysqli($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);

			$query = "UPDATE $tabela SET $dados_set WHERE id = $id";

			$sqli->query($query);

			$sqli->close();

			if(!$sqli->connect_errno){
				return true;
				exit;
			}else{
				return($sqli->error_list);
				exit;
			}

		}else{
			return "Nenhum dado encontrado!";
		}
	}

	public function update_simple($tabela='' ,$value = '', $id='', $campo='')
	{
		if(!empty($tabela)){

			$sqli  = new mysqli($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);

			$query = "UPDATE $tabela SET $campo = '$value' WHERE id = $id";

			$sqli->query($query);

			$sqli->close();

			if(!$sqli->connect_errno){
				return true;
				exit;
			}else{
				return($sqli->error_list);
				exit;
			}

		}else{
			return "Nenhum dado encontrado!";
		}
	}

	public function update_simple_ativa($tabela='' ,$value = '', $id='', $campo='')
	{
		if(!empty($tabela)){

			$sqli  = new mysqli($this->HOST_SERVER, $this->USER_SERVER, $this->PASS_SERVER, $this->DB_SERVER);

			$query = "UPDATE $tabela SET $campo = IF($campo = 0, 1, 0) WHERE id = $id";

			$sqli->query($query);

			$sqli->close();

			if(!$sqli->connect_errno){
				return true;
				exit;
			}else{
				return($sqli->error_list);
				exit;
			}

		}else{
			return "Nenhum dado encontrado!";
		}
	}

}