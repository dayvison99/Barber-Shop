<?php
require("../../config/start.php");

// pre($_POST);
// exit();

// $_POST['id'] = 1;

if (!empty($_POST)) {

	$_SESSION['PL_USER']['dashboard'] = $_POST['periodo'];
	header("location:".PL_PATH_ADMIN.'/home');

}else{

	header("location:".PL_PATH_ADMIN.'/home');
}