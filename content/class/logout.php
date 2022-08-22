<?php

require("../../config/start.php");

// Destrói a sessão
// $_SESSION = array();
session_destroy();

// Redireciona para o login.php
header("location:".PL_PATH_ADMIN);