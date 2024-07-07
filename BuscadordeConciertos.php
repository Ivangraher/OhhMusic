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
        <title>BuscadordeConciertos</title>
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
if($tipo_usuario!=2){
echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
}				
				
		$genero_buscado=$_POST['genero_buscado'];
		$query="select codigo_concierto, nombre_concierto, fecha_concierto, estado_concierto from Concierto 
		where codigo_genero=$genero_buscado;";
		$resultado=mysqli_query($con, $query);
		$rows=mysqli_num_rows($resultado);
		if($rows==0){
		echo "No se han encontrado conciertos -- No hay conciertos registrados.<br/>";
		}
		else{
		echo "<table border=1>
		<tr><td>Nombre del concierto</td><td>Fecha del concierto</td><td>Estado del concierto</td><td>Inscribirse</td></tr>";
		while($fila=mysqli_fetch_array($resultado)){
		extract($fila);
		
		echo "<tr><td>$nombre_concierto</td><td>$fecha_concierto</td><td>$estado_concierto";
			if($estado_concierto==1){
				echo "Concierto en espera";
			}
			if($estado_concierto==2){
				echo "Concierto confirmado";
			}
			if($estado_concierto==3){
				echo "Concierto cancelado";
			}
		echo "</td>";
		echo "<td><a href='Inscribirse.php?codigo_concierto=$codigo_concierto'>Inscribirse al concierto</a></td></tr>";
		}
		}
		echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
		echo "</table>";	
	}
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