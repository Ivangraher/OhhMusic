<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("database.php");
require_once("encriptacion.php");
?>	

<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title>Modificar-perfiles</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
		<link rel="stylesheet" href="CSS/Modificar_Perfiles.css"/>
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
				echo "<a class='botones_perfil' href='LogOut.php'>Log out</a><a class='botones_perfil' href='MiPerfil.php'>Mi Perfil</a>";
				}
?>
</header>


<br>					
<div id='Modificar_Perfiles'>

<?php

$db=new Database();
	
$id=$_SESSION['id_user'];	
$tipo=$_SESSION['tipo_usuario'];

if($tipo==1){
$query2 = "select * from Usuario where codigo_usuario=$id";
$resultado = $db->executer($query2);
$resultado = $db->getResultados();
foreach($resultado as $datos1){
extract($datos1);
}
echo "<form method='post' action='Perfiles.php'>
Nuevo Nombre:<input type='text' name='nuevo_nombre_usu' value='$nombre' readonly/><br/>
<br/>
Nuevo Correo:<input type='text' name='nuevo_correo_usu' value='$correo_usuario'><br/>
<br/>
Nuevo Telefono:<input type='text' name='nuevo_telefono_usu' value='$telefono_usuario'><br/>
<br/>
Nueva Direccion:<input type='text' name='nueva_direccion_usu' value='$direccion_usuario'><br/>
<br/>
Genero:<select name='nuevo_genero_musical'><br/>";
$query = "select * from Genero;";
$resultado = $db->executer($query);
$resultado = $db->getResultados();
foreach($resultado as $genero){
	echo "<option value='$genero[0]'>$genero[1]</option>";
	//echo "<option value='$codigo_genero'>$nombre_genero</option>";
	}
	echo "</select><br/>
	<br/>";
echo "<input type='submit' name='modificar' value='Modificar Perfil'/>";
$db->disconnect();

}

if($tipo==2){
$query3 = "select * from Usuario where codigo_usuario=$id";
$resultado = $db->executer($query3);
$resultado = $db->getResultados();
foreach($resultado as $datos2){
extract($datos2);
}
echo "<form method='post' action='Perfiles.php'>
Nuevo Nombre:<input type='text' name='nuevo_nombre_usu' value='$nombre' readonly/><br/>
<br/>
Nuevo Correo:<input type='text' name='nuevo_correo_usu' value='$correo_usuario'><br/>
<br/>
Nuevo Telefono:<input type='text' name='nuevo_telefono_usu' value='$telefono_usuario'><br/>
<br/>
Nueva Direccion:<input type='text' name='nueva_direccion_usu' value='$direccion_usuario'><br/>
<br/>";
echo "<input type='submit' name='modificar' value='Modificar Perfil'/>";
$db->disconnect();
}

if($tipo==3){
$query4 = "select * from Usuario where codigo_usuario=$id";
$resultado = $db->executer($query4);
$resultado = $db->getResultados();
foreach($resultado as $datos3){
extract($datos3);
}
echo "<form method='post' action='Perfiles.php'>
Nuevo Nombre:<input type='text' name='nuevo_nombre_usu' value='$nombre'readonly/><br/>
<br/>
Nuevo Correo:<input type='text' name='nuevo_correo_usu' value='$correo_usuario'><br/>
<br/>
Genero:<select name='genero_musical'><br/>";
echo "<br/>";
$query = "select * from Genero;";
$resultado = $db->executer($query);
$resultado = $db->getResultados();
foreach($resultado as $genero){
	echo "<option value='$genero[0]'>$genero[1]</option>";
	//echo "<option value='$codigo_genero'>$nombre_genero</option>";
	}
	echo "</select><br/>";
	echo "<br/>";
echo "<input type='submit' name='modificar' value='Modificar Perfil'/>";
$db->disconnect();
}

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