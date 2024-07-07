<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("database.php");
require_once("encriptacion.php");
?>	

<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
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
                       <div id="InfoFan">Esta es la zona de los fans, aqui podras conocer la opini�n de otros fans</div>
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
<div id='P_Fan'>
<div id='Perfil_Fan'>
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
	
$nombre = $_SESSION['nombre_usuario'];
/*$genero_usu = $_SESSION['codigo_usu'];*/
/*$query="select u.nombre, c.nombre_ciudad, u.correo_usuario, u.fecha_nacimiento, g.nombre_genero 
from Usuario u, Genero g, Ciudad c 
where u.codigo_genero=g.codigo_genero and c.codigo_ciudad=u.codigo_ciudad and nombre='$nombre';";*/
$query ="SELECT * FROM Usuario u, Genero g, Ciudad c 
where u.codigo_genero=g.codigo_genero and c.codigo_ciudad=u.codigo_ciudad and nombre='$nombre';";
$resultado = $db->executer($query);
$resultado = $db->getResultados();


foreach($resultado as $datos){
extract($datos);
echo "Nombre: $nombre
</br>
Correo electronico: $correo_usuario
</br>
Fecha de nacimiento: $fecha_nacimiento
</br>
Ciudad: $nombre_ciudad
</br>
Genero del fan: $nombre_genero </br>";
echo "<div id='image'>";
echo "<img src='".$imagen_perfil."'/>";
echo "<br/>";
echo "</div>";

}
}

$db->disconnect();
}
?>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                      <td>
                                             
                                            <span class="dreta">
                                              <a class='btn' href='ModificarPerfiles.php'>Modificar perfil</a>
                                            </span>
                                          
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <a class='btn' href='form.php'>Imagen de Perfil</a>
                                         </span>
                                         
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <a class='btn' href='formulario_buscador.php'>Buscador</a>
                                         </span>
                                           
                                        </td>
                                    </tr>
                                    </tbody>
                            </table></div>
                    <div></div>

</div>
</div>
  <footer>
  <br/>
            <div> Contacto: </div>
            <span>mi_company@correo.com</span>
            <span>93 045 0505</span>
        </footer>
    </body>	

</html>