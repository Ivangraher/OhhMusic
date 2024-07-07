<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datosconexion.php");
require_once("encriptacion.php");
?>	
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title>Registro-Local</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
		<link rel="stylesheet" href="CSS/Registro_Local.css"/>
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

<br/>
<div id='Registro_Local'>
<?php

$con = mysqli_connect("$server", "$user", "$password", "$basededatos")
	or die("No se ha podido conectar con la base de datos.");
		 
echo "<form method='post' action='Local.php'>
	Nombre:<input type='text' name='nombre_local'/><br/>";
	if(isset($_SESSION['error'])){
	echo "Este nombre de usuario ya existe.";
	}
	echo "<br/>";
	echo "Contrasenya:<input type='password' name='contrasenya' value=''/><br/>";
	echo "<br/>";
	echo "Correo:<input type='text' name='correo_local'/><br/>";
	echo "<br/>";
	if(isset($_SESSION['error'])){
	echo "Este correo electronico ya existe.";
	}
	echo "Telefono:<input type='text' name='telefono'/><br/>
	<br/>
	Direccion:<input type='text' name='direccion_local'/><br/>
	<br/>
	Genero:<select name='genero_musical'><br/>";
	echo "<br/>";
	$query = "select * from Genero;";
	$resultado = mysqli_query($con, $query);
	while($fila = mysqli_fetch_array($resultado)){
	extract($fila);
	echo "<option value='$codigo_genero'>$nombre_genero</option>";
	}
	echo"</select><br/>
	<br>Ciudad:<select name='ciudad'><br>";
	$query2 = "select * from Ciudad;";
	$resultado2 = mysqli_query($con, $query2);
	while($fila = mysqli_fetch_array($resultado2)){
	extract($fila);
	echo "<option value='$codigo_ciudad'>$nombre_ciudad</option>";
	}			
	
	echo "<br/>";
	echo "</select><br/>
	<br/>
	<input type='submit' name='musico' value='Registrate'/>";	
	mysqli_close($con);
?>
</div>
  <footer>
  <br/>
            <div> Contacto: </div>
            <span>mi_company@correo.com</span>
            <span>93 045 0505</span>
        </footer>
    </body>

</html>