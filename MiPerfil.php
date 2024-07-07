<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datosconexion.php");

$con = mysqli_connect("$server", "$user", "$password", "$basededatos")
	or die("No se ha podido conectar con la base de datos.");if(!isset($_SESSION['id_user'])){

echo "No has iniciado sesion, seras directamente redireccionado a la Pagina Principal.";
echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
}
else{
$tipo_usuario=$_SESSION['tipo_usuario'];
$con = mysqli_connect("$server", "$user", "$password", "$basededatos")
	or die("No se ha podido conectar con la base de datos.");
if($tipo_usuario!=1){
echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
}
	
	

$tipo=$_SESSION['tipo_usuario'];
if($tipo==1){
echo "<meta http-equiv='Refresh' content='0;url=PerfilLocal.php'>";
}
if($tipo==2){
echo "<meta http-equiv='Refresh' content='0;url=PerfilMusico.php'>";
}
if($tipo==3){
echo "<meta http-equiv='Refresh' content='0;url=PerfilFan.php'>";
}
}
mysqli_close($con);

?>	