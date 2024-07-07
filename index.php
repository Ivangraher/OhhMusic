<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datosconexion.php");
$con = mysqli_connect("$server", "$user", "$password", "$basededatos")
	or die("No se ha podido conectar con la base de datos.");
	
$id=$_SESSION['id_user'];
if(isset($_SESSION['id_user'])){
$query1="SELECT imagen_perfil from Usuario where codigo_usuario=$id";
$result1=mysqli_query($con, $query1);
while($fila=mysqli_fetch_array($result1)){
extract($fila);
}
}
	
?>

<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title>Bienvenido a OhhMusic</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:990px)" href="CSS/mediabasic.css">
    </head>
   <body>
        <header>
            <div id="headerTop" class="withSpace">

                <div class="left">
				<a href='index.php'><img  id="logo" title="logo OhhhMusic" alt="OhhhMusic" src="img/Logo-Proyecto.png" /></a>   
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
                        <div class='button'>LOGIN</div>
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
				echo "<a class='btn' href='LogOut.php'>Log out</a>
				<div id='imagen_perfil'><a href='MiPerfil.php'><img src='".$imagen_perfil."'/></a></div>";
				//echo "<a href='LogOut.php'>Log out</a><a href='MiPerfil.php'>Mi Perfil</a>";
				}
?>
                </div>

                <div></div>
                <div class="withSpace"></div>
            </div>
            <div class="botonsTop">
                <div class="button"><a href="#topLlista1">TOP MUSICS</a></div>
                <div class="button"><a href="#topLlista2">TOP LOCALS</a></div>
                <div class="button"><a href="#topLlista3">CONCERTS</a></div>
            </div>
        </header>
        <div id="main">
            <div class="withSpace">
                <div id="mitgPrincipal">
                    <div></div>
                    <section id="topLlista1" class="topTable">
                        <header>TOP MUSICS</header>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                      <td>
                                            <span class="dreta">
                                                <img src="img/Phil Collins.png"/>
                                            </span>
                                            <audio controls autoplay loop preload="auto">
                                            <source src="audio/wewish.mp3" type="audio/mpeg">
					     Audio no disponible.
					    </audio>
                                          <div>Phil Collins.</div>
					<div>Fue miembro de la banda Genesis donde se dio a conocer y luego empezo su gran carrera en solitario, donde ha conseguido toda su fama musical.</div>                               
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <img src="img/Logo-PK.png"/>
                                         </span>
                                         <audio controls autoplay loop preload="auto">
					    <source src="audio/wewish.mp3" type="audio/mpeg">
                                            Audio no disponible.
					    </audio>
                                           <div>Pink Floyd.</div>
                                           La banda se fundo en el año 1964 por la mano de: David Gilmour, Nick Mason, Bob Klose, Roger Waters y Rick Wright. Su estilo es Rock psicodelico.
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <img src="img/The Police-logo.png" />
											 
                                         </span>
                                         <audio controls autoplay loop preload="auto">
					    <source src="audio/wewish.mp3" type="audio/mpeg">
                                            Audio no disponible.
					    </audio>
                                            <div> The Police </div>
                                            <div> La banda se fundo en el año 1977 por la mano de: Sting, Andy Summers, Stewart Copeland, Henry Padovani. </div>
                                       </td>
                                    </tr>
                                    </tbody>
                            </table></div>
                    </section>
                    <div></div>
                    <section
                        id="topLlista2" class="topTable">
                        <header>TOP LOCALS</header>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                      <td>
                                             
                                            <span class="dreta">
                                                <img src="img/Local 1.png"/>
                                            </span>
                                          <div>Local que te transmitira el ritmo in the body</div>
                                            </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <img src="img/Local 2.png"/>
                                         </span>
                                          Disfruta del gran espectaculo de la musica en directo.
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <img src="img/Local 3.png"/>
                                         </span>
                                           Local reconocido donde disfrutar de la buena musica.
                                        </td>
                                    </tr>
                                    </tbody>
                            </table></div>
                    </section>
                    <div></div>
                    <section 
                        id="topLlista3" class="topTable">
                        <header>CONCERTS</header>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                      <td>
                                             
                                            <span class="dreta">
                                                <img src="img/Concierto 1.png"/>
                                            </span>
                                          <div>Concierto donde te dejaras llevar por el ritmo de la musica.</div>
                                            
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <img src="img/Concierto 2.png"/>
                                         </span>
                                            <div>Disfruta del mayor espectaculo musical de tu vida.</div>
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                             <img src="img/Concierto 3.png"/>
                                         </span>
                                            <div>Experiencia unica en la vida.¿Te la vas a perder?</div>
                                        </td>
                                    </tr>
                                    </tbody>
                            </table></div>
                    </section>
       
                    <div class="withSpace"></div>
                </div>
                <aside id="addPrincipal">
                    <img src="img/Tienda 1.png">
                    <img src="img/Tienda 2.png">
                </aside>
            </div>
        </div>
        <footer>
            <div> Contacto: </div>
            <span>mi_company@correo.com</span>
            <span>93 045 0505</span>
        </footer>
    </body>

</html>
<?php
mysqli_close($con);
?>