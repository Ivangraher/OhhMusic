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
        <title>Busqueda-Fan</title>
        
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
<div id='B_Fan'>
<div id='Busqueda_Fan'>

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
//variables del buscador
$nombre_buscado=$_POST['nombre_busqueda'];
$ciudad_buscada=$_POST['ciudad_busqueda'];
$genero_buscado=$_POST['genero_busqueda'];
$tipo_buscado=$_POST['tipo_busqueda'];
$codigo_fan=$_SESSION['id_user'];
//tabla del buscador
$sql="";
if($tipo_buscado == 1){//local
	$sql="select * from Usuario u, Ciudad c, Genero g where tipo=1 and u.codigo_ciudad=c.codigo_ciudad and u.codigo_genero=g.codigo_genero";
}
else if($tipo_buscado == 2){//musico
	$sql="select * from Usuario u, Ciudad c, Genero g where tipo=2 and u.codigo_ciudad=c.codigo_ciudad and u.codigo_genero=g.codigo_genero";
}
else{
$sql="select * from Concierto con, Genero g, Ciudad c, Usuario u where 1=1 and estado_concierto=2 and con.codigo_genero=g.codigo_genero and con.codigo_usuario=u.codigo_usuario and u.codigo_ciudad=c.codigo_ciudad";
}
if(!empty($_POST['genero_busqueda'])){
	$sql=$sql." and g.codigo_genero=".$_POST['genero_busqueda'];
}
if(!empty($_POST['ciudad_busqueda'])){
	$sql=$sql." and c.codigo_ciudad=".$_POST['ciudad_busqueda'];
}
if(!empty($_POST['nombre_busqueda']) && ($tipo_buscado == 1) || ($tipo_buscado == 2)){
	$sql=$sql." and nombre like '%".$_POST['nombre_busqueda']."%'";
}

else if(!empty($_POST['nombre_busqueda']) && ($tipo_buscado == 3)){
$sql=$sql." and nombre like '%".$_POST['nombre_busqueda']."%'";
}


if($tipo_buscado == 1){//busqueda locales
	$db->executer($sql);
	$result1=$db->getResultados($sql);
	$rows=$db->getNumRows($sql);
	if($rows==0){
		echo "No existen resultados con los parametros marcados";
	}
	else{
		echo "<table border=1>";
				echo "<tr><td>Nombre del local</td><td>Genero del local</td><td>Ciudad del local</td></tr>";
					foreach($result1 as $locales){
						extract($locales);
						echo "<tr><td>$nombre</td><td>$nombre_genero</td><td>$nombre_ciudad</td></td>";
						$query1="SELECT * FROM votacion_usuario WHERE codigo_fan=$codigo_fan and codigo_votado=$codigo_usuario";
						$db->executer($query1);
						$rows=$db->getNumRows($query1);
						if($rows==1){
							echo "<td>Ya has votado a este local</td>";
						}
						else{
						echo "<td><a href='VotacionesLocales.php?codigo=$codigo_usuario'>Votar local</a></td></tr>";
						
						}
					}
					
					
		echo "</tr>";
		echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
		echo "</table>";
	}
}
else if($tipo_buscado == 2){//busqueda musicos
	$db->executer($sql);
	$result2=$db->getResultados($sql);
	$rows=$db->getNumRows($sql);
	if($rows==0){
		echo "No existen resultados con los parametros marcados";
	}
	else{
		echo "<table border=1>";
				echo "<tr><td>Nombre del musico</td><td>Genero del musico</td><td>Ciudad del musico</td></tr>";
					foreach($result2 as $musicos){
						extract($musicos);
						echo "<tr><td>$nombre</td><td>$nombre_genero</td><td>$nombre_ciudad</td>";
						$query2="SELECT * FROM votacion_usuario WHERE codigo_fan=$codigo_fan and codigo_votado=$codigo_usuario";
						$db->executer($query2);
						$rows=$db->getNumRows($query2);
						if($rows==1){
							echo "<td>Ya has votado a este musico</td>";
						}
						else{
						echo "<td><a href='VotacionesMusicos.php?codigo=$codigo_usuario'>Votar musico</a></td></tr>";
						}
					}
					
					
		echo "</tr>";
		echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
		echo "</table>";
	}
}
else{//busqueda conciertos
	$db->executer($sql);
	$result3=$db->getResultados($sql);
	$rows=$db->getNumRows($sql);
	if($rows==0){
		echo "No existen resultados con los parametros marcados";
	}
	else{
		echo "<table border=1>";
				echo "<tr><td>Nombre del concierto</td><td>Genero del concierto</td><td>Ciudad del concierto</td></tr>";
					foreach($result3 as $conciertos){
						extract($conciertos);
						echo "<tr><td>$nombre_concierto</td><td>$nombre_genero</td><td>$nombre_ciudad</td>";
						$query3="SELECT * FROM votacion_concierto WHERE codigo_fan=$codigo_fan and codigo_concierto=$codigo_concierto;";
						$db->executer($query3);
						$rows=$db->getNumRows($query3);
						if($rows==1){
						echo "<td>Ya has votado este concierto</td></tr>";
						}
						else{
						echo "<td><a href='VotacionesConciertos.php?codigo_concierto=$codigo_concierto'>Votar concierto</a></td></tr>";
						}
					}
					
					
		echo "</tr>";
		echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
		echo "</table>";
	}
}
}
$db->disconnect();
}
?>
</div>
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