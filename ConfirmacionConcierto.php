<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datosconexion.php");
require_once("encriptacion.php");
?>	
	
<html>
    <head>
        <title>ConfirmacionConcierto</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:990px)" href="CSS/mediabasic.css">
    </head>
   <body>
        <header>

            <div id="headerTop" class="withSpace">

                <div class="left">
                    <a href='index.php'><img  id="logo" title="logo OhhhMusic" alt="OhhhMusic" src="img/Logo-Proyecto.png" />    
                </div>
                <div class="middle"> 
                    <section>
                   <nav> 
                            <ul style="list-style-type: none">
                            <li><a href="#InfoOhhMusic">Conoce OhhMusic</a></li>
                            <li><a href="#InfoLocal">Tienes local?</a></li>
                            <li><a href="#InfoMusico">Eres musico?</a></li>
                            <li><a href="#InfoFan">Encuentra a tus idolos</a></li>
                        </ul>
                     </nav>
                    <div class="Infolinks">
                        <div id="InfoOhhMusic">OhhMusic es la mejor pagina sobre musica </div>
                       <div id="InfoFan">Esta es la zona de los fans, aqui podras conocer la opinión de otros fans</div>
                       <div id="InfoMusico">Descubre la zona de los musicos</div>
                       <div id="InfoLocal">Descubre la zona de los locales</div>
                    </div>
                    </section>
                </div>
                
                <div class="right">
                    <span >
                        <a href="#"><img alt="Facebook" src="img/icono-facebook.png"/></a>
                        <a href="#"><img alt="Twitter" src="img/icono-twitter.png"/></a>
                    </span>
<?php
				if(!isset($_SESSION['id_user'])){
					echo "<div class='contDesplegable'>
                        <div class='login button'>LOGIN</div>
                        <form class='hidDesplegable' method='post' action='Login.php'>
                            <label for='inputNombre'>nombre</label>
                            <input name='nombre' id='inputNombre' type='text'>
                            <label for='inputPass'>password</label>
                            <input name='pass' id='pass' type='password'>
                            <input type='submit'  value='Login'>
                        </form>
                    </div>
					
                    
                    <div class='contDesplegable registre'>
                        <div class='registre button'>REGISTRATE</div>
                        <form id='login_1' class='hidDesplegable'>
                            <a href='RegistroLocal.php'><label for='inputLocal'>Local</label></a>
                            <br><a href='RegistroMusico.php'><label for='inputMusico'>Musico</label></a></br>
                            <a href='RegistroFan.php'><label for='inputFan'>Fan</label></a>
                        </form>
                    </div>
                </div>";
				}
				else{
				echo "<a href='LogOut.php'>Log out</a><a href='MiPerfil.php'>Mi Perfil</a>";
				}
?>
			
</header>
<br>
<?php
	
$con = mysqli_connect("$server", "$user", "$password", "$basededatos")
	or die("No se ha podido conectar con la base de datos.");
	
	if(!isset($_SESSION['id_user'])){

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
$codigo=$_GET['codigo'];
$nuevo_nombre = $_POST['nuevo_nombre_concierto'];
$nueva_fecha_concierto = date('Y/m/d', strtotime($_POST['nueva_fecha']));
$nuevo_codigo_genero = $_POST['nuevo_genero_musical'];

$query = "update Concierto set nombre_concierto = '$nuevo_nombre', fecha_concierto ='$nueva_fecha_concierto', codigo_genero='$nuevo_codigo_genero' where codigo_concierto=$codigo;";
$resultado = mysqli_query($con, $query);
echo "El concierto ha sido modificado correctamente";
echo "<meta http-equiv='Refresh' content='2;url=PerfilLocal.php'>";
}
mysqli_close($con);
?>