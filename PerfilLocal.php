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
        <title>Perfil-Local</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
		<link rel="stylesheet" href="CSS/Perfil_Local.css"/>
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
<div id='P_Local'>				
<div id='Perfil_Local'>


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

	
	
$nombre = $_SESSION['nombre_usuario'];	
$codigo_genero = $_SESSION['genero_usu'];	
$query = "select u.nombre, c.nombre_ciudad, u.correo_usuario, u.telefono_usuario, u.direccion_usuario, g.nombre_genero, u.imagen_perfil 
from Usuario u, Ciudad c, Genero g where u.codigo_genero=g.codigo_genero and c.codigo_ciudad=u.codigo_ciudad and nombre='$nombre';";
$resultado = mysqli_query($con, $query);
while($fila = mysqli_fetch_array($resultado)){
extract($fila);
}
echo "Nombre del local: $nombre
</br>
Correo electronico: $correo_usuario
</br>
Telefono del local: $telefono_usuario
</br>
Dirección del local: $direccion_usuario
</br>
Genero del local: $nombre_genero
</br>";

echo "<div id='image'>";
echo "<img src='".$imagen_perfil."'/>";
}
mysqli_close($con);

?>
<div>
                            <table>
                                <tbody>
                                    <tr>
                                      <td>
                                             
                                            <span class="dreta">
                                              <a class='btn' href='TablaConcierto.php'>Ver Conciertos</a>
                                            </span>
                                          
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                            <a class='btn' href='RegistroConcierto.php'>Crear Conciertos</a>
                                         </span>
                                         
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <a class='btn' href='ModificarPerfiles.php'>Modificar perfil</a>
                                         </span>
                                           
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                            <a class='btn' href='form.php'>Imagen de Perfil</a>
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