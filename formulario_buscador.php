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
        <title>Perfil-Fan</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
		<link rel="stylesheet" href="CSS/Perfil_Fan.css"/>
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
<div id='F_Buscador'>
<div id='Formulario_Buscador'>
<?php
if(!isset($_SESSION['id_user'])){
					echo "No has iniciado sesion, seras redireccionado a la pagina principal.";
					echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
					
				}
else{
		$tipo_usuario=$_SESSION['tipo_usuario'];
		if($tipo_usuario!=3){
				echo "No has iniciado sesion, seras directamente redireccionado a la Pagina Principal.";
				echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
				}
else{
$db=new Database();

echo "<form method='post' action='BusquedaFan.php'>";
echo "Nombre:<input type='text' name=nombre_busqueda'><br/>";
echo "<br/>";

//desplegable de los generos musicales
echo "Genero:<select name='genero_busqueda'><br/>";
$query="select * from Genero;";
$result=$db->executer($query);
$result=$db->getResultados();
echo "<option></option>";
foreach($result as $genero){
echo "<option value='$genero[0]'>$genero[1]</option>";
}
echo "</select><br/>";
echo "<br/>";

//desplegable de las ciudades
echo "Ciudad:<select name='ciudad_busqueda'><br/>";
$query2="select * from Ciudad;";
$result2=$db->executer($query2);
$result2=$db->getResultados();
echo "<option></option>";
foreach($result2 as $ciudad){
echo "<option value='$ciudad[0]'>$ciudad[1]</option>";
}
echo "</select><br/>";
echo"<br/>";

//desplegable del tipo de usuario
echo "Tipo:<select name='tipo_busqueda'>";
echo "<option value=1>Local</option>
<option value=2>Musico</option>
<option value=3>Concierto</option>";
echo "</select></br>";
echo "<br/>";
echo "<input type='submit' name='submit' value='Buscar'/>

</select>
</form>";
}
$db->disconnect();
}
?>
</div>
	</div>
</html>