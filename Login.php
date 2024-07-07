<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datosconexion.php");
require_once("encriptacion.php");
?>	
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>Login</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:990px)" href="CSS/mediabasic.css">
    </head>
   <body>
        <header>

            <div id="headerTop" class="withSpace">

                <div class="left">
                    <img  id="logo" title="logo OhhhMusic" alt="OhhhMusic" src="img/Logo-Proyecto.png" />    
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
</html>
<br>
<?php

$con = mysqli_connect("$server", "$user", "$password", "$basededatos")
	or die("No se ha podido conectar con la base de datos.");
		
	$nombre = $_POST['nombre'];
	$pass = $_POST['pass'];
	
	$options = ['cost' => 7, 'salt' => 'BCryptRequires22Chrct2'];
	$password_encriptado = password_hash($pass, PASSWORD_BCRYPT, $options);
	$query = "select codigo_usuario, nombre, tipo, codigo_genero from Usuario where nombre = '$nombre' and contrasenya = '$password_encriptado'";
	$resultado = mysqli_query($con, $query);
	$rows = mysqli_num_rows($resultado);
		
	if($rows ==1){
	$object = mysqli_fetch_array($resultado);
	extract($object);
	$_SESSION['id_user']=$codigo_usuario;
	$_SESSION['nombre_usuario']=$nombre;
	$_SESSION['tipo_usuario']=$tipo;
	$_SESSION['genero_usu']=$codigo_genero;
	echo "Login correcto. Bienvenido a OhhMusic!!!";
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
	else{
	echo "Login incorrecto. El nombre del usuario o la contraseña son incorrectas";
	}
		
	mysqli_close($con);
?>