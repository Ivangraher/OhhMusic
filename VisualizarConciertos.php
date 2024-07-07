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
                </div>
        </header>
<br/>
<div id='V_Conciertos'>
<div id='Visualizar_Conciertos'>
<?php
if(!isset($_SESSION['id_user'])){

echo "No has iniciado sesion, seras directamente redireccionado a la Pagina Principal.";
echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
}
else{
$tipo_usuario=$_SESSION['tipo_usuario'];
$db=new Database();
if($tipo_usuario!=3){
echo "<meta http-equiv='Refresh' content='5;url=index.php'>";

				}
else{
				$tipo_usuario=$_SESSION['tipo_usuario'];
				$db=new Database();
			
			
				$codigo_fan=$_SESSION['id_user'];
				$nombre_musico;
				$query="SELECT codigo_concierto, nombre_concierto, fecha_concierto, nombre_genero, musico.nombre as nombre_musico, u.nombre
				from Concierto c, Usuario u, Usuario musico, Genero g WHERE c.codigo_usuario=u.codigo_usuario and c.codigo_genero=g.codigo_genero and codigo_musico!=0 and codigo_musico=musico.codigo_usuario";
				/*$query="SELECT * FROM Concierto c, Usuario u, Genero g 
				WHERE c.codigo_usuario=u.codigo_usuario and u.codigo_genero=g.codigo_genero and u.tipo=1 and c.codigo_musico!=0";*/
				$db->executer($query);
				$result=$db->getResultados($query);
				echo "<table border=1>";
				echo "<tr><td>Nombre del Concierto</td><td>Fecha del Concierto</td><td>Genero del Concierto</td><td>Local que organiza el Concierto</td>
				<td>Musico que toca en el Concierto</td>";
				foreach($result as $concierto){
				extract($concierto);
				
				echo "<tr><td>$nombre_concierto</td><td>$fecha_concierto</td><td>$nombre_genero</td><td>$nombre</td>";
				$query2 ="SELECT codigo_musico, nombre FROM Concierto c, Usuario u WHERE c.codigo_musico=u.codigo_usuario and 																		c.codigo_concierto=$codigo_concierto";
				$db->executer($query2);
				$result2=$db->getResultados($query2);
				$query3= "SELECT * FROM Concierto where codigo_musico!=0";
				$db->executer($query3);
				$result3=$db->getResultados($query3);
				$rows=$db->getNumRows($query3);
				if($rows!=0){
				foreach($result2 as $musico){
				extract($musico);
				$nombre_musico=$nombre;
				echo"<td>$nombre_musico</td>";
				}
				}
				
				$query4="SELECT * FROM votacion_concierto WHERE codigo_fan=$codigo_fan and codigo_concierto=$codigo_concierto";
				$db->executer($query4);
				$rows2=$db->getNumRows($query4);
				if($rows2==1){
				echo "<td>Ya has votado a este concierto.</td></tr>";
				}
				else{
				echo "<td><a href='VotacionesConciertos.php?codigo_concierto=$codigo_concierto'>Votar concierto</a></td>";
				}
				
				}
					echo "</tr>";
					echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
					echo "</table>";		
				
						
				}					
				
				
				
						
$db->disconnect();
}

?>
</div>
</div>
<footer>
            <div> Contacto: </div>
            <span>mi_company@correo.com</span>
            <span>93 045 0505</span>
        </footer>
    </body>

</html>