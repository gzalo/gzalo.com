<?php

//error_reporting(E_ALL); ini_set('display_errors', 1);

	require_once('inc/fcn.php');

	/*if($_SERVER['HTTP_HOST']!='gzalo.com'){
		Header('HTTP/1.1 301 Moved Permanently');
		Header('Location: http://gzalo.com'. $_SERVER['REQUEST_URI']);
		exit();
	}*/
	
	$navString = str_replace(chr(0), '', $_SERVER['REQUEST_URI']); 
	$parts = explode('/', $navString);
	
	$tituloPagina = '';
	$descripcionPagina = '';
	$contenidoPagina = '';
	$comentariosActivados = true;
	
	$seccionesValidas=array('buscar', 'pld', 'cs_electronicaort', 'rs232ttl', 'miniconsola', 'teclado4x4', 'adc', 'puenteh', 'intropic', 'rfht12', 'casas', 'lcdgrafico', 'lcdalfanumerico', 'expandir', 'ledmatrix', 'software', 'gsm', 'gps', 'ram8052', 'i2c', 'sdl', 'compiladores_gnu','shaders','motor_tiles', 'worms','ircam','sensores_inclinacion','electronica_tcg','alephtrack','electroestimulador','cerradura','consola_tv','tpg_intro','tp_labodemicros','divisor_resistivo', 'timer', 'resistencias_led', '555', 'filrorc', 'regulador', 'codigo_capacitores', 'codigo_resistencias', 'filtrorc', 'proyectos', 'articulos_electronica','articulos_se','articulos_programacion','articulos_varios','rulemanes',
	'index_en', 'analisis_de_circuitos', 'algoritmos_kuhn','worms_en','tile_engine_en', 'electronica_tgc_en', 'tpg_intro_en', 'cs_electronicaort_en', 'lock_en', 'electrostimulator_en', 'rs232ttl_en', 'inclination_sensor_en', 'adc_en', 'keyboard4x4_en', '555_en', 'search', 'capacitor_code_en', 'resistor_code_en', 'gnu_compilers_en', 'console_tv_en', 'resistive_divider_en', 'timer_en', 'led_resistor_en', 'rcfilter_en', 'regulator_en', 'miniconsole_en', 'tp_labodemicros_en', 'electronica_tcg_en', 'ircam_en', 'shaders_en', 'sdl_en', 'hbridge_en', 'intropic_en', 'pld_en', 'rfht12_en', 'ledmatrix_en', 'gps_en', 'gsm_en', 'graphicallcd_en', 'expansion_en', 'ram8052_en', 'alphanumericlcd_en', 'i2c_en', 'software_en', 'halfmapper_en', 'motor_fisico', 'motor_fisico', 'physics_engine_en','projects','articles_electronics','articles_es','articles_programming','articles_misc');
	
	ob_start();
	$lang = 'es';
		
	if($parts[1] == ''){
		include('pages/index.php');
	}else{
		if(!in_array($parts[1], $seccionesValidas)){
			loggear("Error, intento acceder seccion no valida: ". $navString);
			Header('HTTP/1.1 301 Moved Permanently');
			Header('Location: /');
			exit();
		}else{
			$archivoAIncluir = 'pages/'.$parts[1].'.php';
			
			if(!is_readable($archivoAIncluir)){
				loggear("Error, seccion valida dio 404: ". $navString);
				Header('HTTP/1.1 301 Moved Permanently');
				Header('Location: /');
				exit();
			}else{
				include($archivoAIncluir);
			}
		}
	}
	
	if($lang == 'es'){
		$slogan = "Electrónica, programación y otras cosas";
	}else{
		$slogan = "Electronics, programming & other stuff";
	}	
	
	$contenidoPagina = ob_get_contents();
	
	ob_end_clean();
	
?><!DOCTYPE HTML>
<html lang="<?php echo $lang;?>">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" media="screen" href="/css/w3.css" >
		<link href='https://fonts.googleapis.com/css?family=Oswald|Raleway' rel='stylesheet' type='text/css'>		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <title><?php echo $tituloPagina; ?> | Gzalo.com</title> 
		<meta name="description" content="<?php echo $descripcionPagina;?>">
		<script>
		<?php
			if($lang == 'en') echo 'var disqus_config = function () { this.language = "en"; };';
		?>
		</script>
    </head>
    <body>
			
        <header class="w3-display-container">

			<div class="w3-container w3-display-middle w3-center">
            <h1 class="w3-jumbo color_header_h">Gzalo<span class="w3-xlarge">.com</span></h1>
            <h2 class="w3-large w3-hide-medium w3-hide-small color_header_h"><?php echo $slogan;?></h2>
			</div>
		</header>
		
		<nav> 
			<?php
				if($lang == 'es'){
					include("pages/nav_es.php");
				}else{
					include("pages/nav_en.php");
				}
			?>			
        </nav>
		<section class="w3-row w3-content">
		   <article class="w3-container w3-twothird	">
		   
			<?php
				echo $contenidoPagina;
				if($comentariosActivados){
			?>
			
			<div class="w3-card-2 w3-margin-top w3-white">

				<header class="w3-container color_headers">
					<h2>Comentarios</h2>
				</header>

				<div class="w3-container w3-center">
											   
					<div id="disqus_thread"></div>

					<script type="text/javascript">
						/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
						var disqus_shortname = 'gzalo'; 

						/* * * DON'T EDIT BELOW THIS LINE * * */
						(function() {
							var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
							dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
							(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						})();
					</script>
					<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				</div>

			</div>

			
			<?php
				}
			?>			
			</article>

			<aside class="w3-container w3-third">
				<?php
					if($lang == 'es'){
						include("pages/sidebar_es.php");
					}else{
						include("pages/sidebar_en.php");
					}
				?>
			</aside>
		</section>
	
	
	<footer class="color_footer w3-padding-16 w3-center w3-margin-top">
		<p><a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" class="w3-hover-text-blue"><i class="fa fa-creative-commons"></i></a> 2006-2020 - Gzalo.com by Gonzalo Ávila Alterach</p>
		<p class="w3-xlarge w3-text-blue"><a href="mailto:gonzaloavilaalterach@gmail.com" class="w3-hover-text-white w3-padding-small"><i class="fa fa-envelope"></i></a>
		<a href="http://www.facebook.com/gzalocom" class="w3-hover-text-white w3-padding-small"><i class="fa fa-facebook-official"></i></a>
		<a href="https://www.linkedin.com/in/gonzalo-ávila-alterach-21a63626" class="w3-hover-text-white w3-padding-small"><i class="fa fa-linkedin"></i></a>
		<a href="http://youtube.com/gzaloprgm" class="w3-hover-text-white w3-padding-small"><i class="fa fa-youtube"></i></a>
		<a href="https://github.com/gzalo" class="w3-hover-text-white w3-padding-small"><i class="fa fa-github"></i></a></p>
	</footer>
	
    <script>
	
	function open_search(elmnt) {
		var a = document.getElementById("in_busqueda");

		if (a.classList.contains("w3-hide")){
			a.classList.remove("w3-hide");
			document.getElementById("in_busqueda").getElementsByTagName('input')[0].focus(); 
			elmnt.innerHTML = "<i class='fa fa-times-circle'></i>";
		} else {
			a.classList.add("w3-hide");
			elmnt.innerHTML = "<i class='fa fa-search'></i>";    
		}
	}

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-11919886-4', 'auto');
	  ga('send', 'pageview');
	</script>
</body>
</html>
