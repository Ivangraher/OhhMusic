<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datosconexion.php");
require_once("encriptacion.php");
require_once("database.php");
?>	
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title>Fan</title>
        
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
</html>
<br>
<?php
$db=new Database();

	$nombre = $_POST['nombre_fan'];
	$contrasenya = $_POST['contrasenya'];
	$ciudad = $_POST['ciudad'];
	$correo = $_POST['correo_fan'];
	$fecha_nacimiento = date('Y/m/d', strtotime($_POST['fecha_nacimiento']));
	$genero_fan = $_POST['genero_musical'];
	$ciudad_fan = $_POST['ciudad'];
	
	//comprobar que el nombre de usuario no esta repetido
	$query3 = "select * from Usuario where nombre = '$nombre'";
	$result3 = $db->executer($query3); 
	if($db->getNumRows($result3)== 1){
		$_SESSION['error'] = "Este nombre de usuario ya existe";
		echo "<meta http-equiv='Refresh' content='5;url=RegistroFan.php'>";
	}
	
	//comprobar que el correo electronico no esta repetido
	$query4 = "select * from Usuario where correo_usuario = '$correo'";
	$result4 = $db->executer($query4); 
	
	if ($db->getNumRows($result4) == 1){
		$_SESSION['error'] = "Este correo electronico ya existe";
		echo "<meta http-equiv='Refresh' content='5;url=RegistroFan.php'>";
	}
	
	else{
	unset($_SESSION['error']);
	$options = ['cost' => 7, 'salt' => 'BCryptRequires22Chrct2'];
	$password_encriptado = password_hash($contrasenya, PASSWORD_BCRYPT, $options);
	$query5 = "insert into Usuario(nombre, contrasenya, correo_usuario, fecha_nacimiento, codigo_ciudad, codigo_genero, tipo, imagen_perfil) 
	values ('$nombre', '$password_encriptado', '$correo', '$fecha_nacimiento' ,'$ciudad_fan', '$genero_fan', 3, 'imagenes/perfil_predefinido.jpg');";
	$result5 = $db->executer($query5); 
	
	echo "Registro Finalizado";
	echo "Bienvenido a OhhMusic!!!";
	echo "<meta http-equiv='Refresh' content='2;url=index.php'>";
	}
	
	$db->disconnect();
	
?>