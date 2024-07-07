<?php
	session_start();
	if(!isset($_SESSION['id_user'])){
	header("Location:index.php");
	}
	
	/*$_SESSION['id_user'] = // codigo del usuario logeado(login)
	
	
?>