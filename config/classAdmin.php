<?php

/* 
CREATE TABLE IF NOT EXISTS `admin` (
`id` varchar(40) DEFAULT NULL,
`email` varchar(100) DEFAULT NULL,
`password` varchar(100) DEFAULT NULL,
`username` varchar(100) DEFAULT NULL,
`enabled` varchar(100) DEFAULT NULL,
`cpf` varchar(100) DEFAULT NULL,
`photo` varchar(100) DEFAULT NULL,
`created` varchar(100) DEFAULT NULL,
`updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

*/

class Admin {
    private $Id;
	private $Email;
    private $Password;
    private $Username;
	private $Enabled;
    private $Cpf;
    private $Photo;
    private $Created;
	private $Updated;
	
	   
    public function __construct($email='',$password='',$username='',$enabled='',$cpf='',$photo='', $created='', $updated=''){
		$this->Email = $email;
		$this->Password = $password;
		$this->Username = $username;
		$this->Enabled = $enabled;
		$this->Cpf= $cpf;
		$this->Photo = $photo;   
		$this->Created = $created;   
		$this->Updated = $updated;   
	}

	public function inserir($link) {
		$sql ="INSERT INTO `admin` VALUES ('".$this->Email."','".$this->Password."','".$this->Username."','".$this->Enabled."','".$this->Cpf."','".$this->Photo."',null,'".$this->Created."','".$this->Updated."')";
		if (mysqli_query($link,$sql)) {
			return true;
		}
		else
		return false;
	}   
	
	public function updateSenha($link,$Email) {
		$sql ="UPDATE `admin` SET `SenhaUsuario`='".$this->SenhaUsuario."' WHERE `email` = '".$Email."'";
		if (mysqli_query($link,$sql)) {
			return true;
		}
		else
		return false;
	}
		
	public function ultimoAcesso($link, $Email) {
		$data = date('Y-m-d H:i:s');
		$sql = "UPDATE  `admin` SET  `updated` =  '".$data."' WHERE  `email` =  '".$Email."'";
		if (mysqli_query($link,$sql)) {
			return true;
		}
		else
		return false;
	}   
		

}
