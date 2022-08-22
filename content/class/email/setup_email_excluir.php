<?php
require("../../../config/start.php");

$sqli = $bd->conexao();

$query = "DELETE FROM setup_email";
$sqli->query($query);

header("location:".PL_PATH_ADMIN.'/setup_email');

?>