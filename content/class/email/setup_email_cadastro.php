<?php
require("../../../config/start.php");

if (!empty($_POST)) {

	$sqli = $bd->conexao();

  if(isset($_POST['host']) && !empty($_POST['host'])){
    $host = $_POST['host'];
  }else{
    $host = "";
  }
  
  if(isset($_POST['usuario']) && !empty($_POST['usuario'])){
    $usuario = $_POST['usuario'];
  }else{
    $usuario = "";
  }
  
  if(isset($_POST['senha']) && !empty($_POST['senha'])){
    $senha = $_POST['senha'];
  }else{
    $senha = "";
  }

  if(isset($_POST['porta']) && !empty($_POST['porta'])){
    $porta = $_POST['porta'];
  }else{
    $porta = "";
  }

  $query ="SELECT * FROM setup_email";
  $setup = $sqli->query($query);

  $id = $_POST['id'];
  if($setup->num_rows > 0 && $id != 0){
    $query_update = "UPDATE setup_email SET host = '$host', usuario = '$usuario', senha = '$senha', porta = '$porta' WHERE id = $id";
    $sqli->query($query_update);
  } else {
    $query_cadastro = "INSERT INTO setup_email VALUES (NULL, '$host', '$usuario', '$senha', '$porta')";
    $sqli->query($query_cadastro);
    $id = $sqli->insert_id;
  }   

  if($sqli->connect_errno){
    echo $sqli->error;
    pre($sqli->error_list);
    exit;
  }

  header("location:".PL_PATH_ADMIN.'/setup_email');
}else{
	header("location:".PL_PATH_ADMIN.'/setup_email');
}