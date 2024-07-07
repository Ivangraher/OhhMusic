<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("database.php");
require_once("encriptacion.php");


if(!isset($_SESSION['id_user'])){

echo "No has iniciado sesion, seras directamente redireccionado a la Pagina Principal.";
echo "<meta http-equiv='Refresh' content='5;url='index.php'>";
}
else{
$tipo_usuario=$_SESSION['tipo_usuario'];
$db=new Database();
if($tipo_usuario!=3){
echo "<meta http-equiv='Refresh' content='5;url='index.php'>";

				}

				else{
					$tipo_usuario=$_SESSION['tipo_usuario'];
				$db=new Database();
				if($tipo_usuario!=3){
					header("Location:index.php");
				}
				else{
				$codigo_concierto=$_GET['codigo_concierto'];
				$codigo_fan=$_SESSION['id_user'];
				$query="INSERT INTO votacion_concierto(codigo_fan, codigo_concierto)
				values ($codigo_fan, $codigo_concierto)";
				$db->executer($query);
				header("Location:VisualizarConciertos.php");
								
				}
				}
				}
						
$db->disconnect();
	
?>